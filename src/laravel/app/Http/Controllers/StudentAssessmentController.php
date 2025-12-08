<?php

namespace App\Http\Controllers;

use App\Models\Scheduling;
use App\Models\RecordAssessment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentAssessmentController extends Controller
{
    /**
     * Display a listing of available assessments for the student
     */
    public function index()
    {
        $userId = auth()->id();
        
        // Buscar agendamentos já feitos pelo aluno
        $mySchedulings = Scheduling::with(['discipline'])
            ->where('user_id', $userId)
            ->orderBy('scheduling', 'desc')
            ->get();

        // IDs de disciplinas que o aluno já agendou
        $scheduledDisciplineIds = $mySchedulings->pluck('discipline_id')->toArray();

        // IDs de disciplinas que o aluno já realizou a prova
        $completedDisciplineIds = \DB::table('disc_sched')
            ->where('user_id', $userId)
            ->whereNotNull('score')
            ->pluck('discipline_id')
            ->toArray();

        // Combinar disciplinas agendadas e completadas
        $excludedDisciplineIds = array_unique(array_merge($scheduledDisciplineIds, $completedDisciplineIds));

        // Buscar avaliações disponíveis (dentro do período) 
        // EXCLUINDO aquelas que o aluno já agendou ou já fez
        $availableAssessments = RecordAssessment::with('discipline')
            ->where('end_date', '>=', Carbon::today())
            ->whereNotIn('discipline_id', $excludedDisciplineIds)
            ->get();

        return view('student-assessments.index', compact('availableAssessments', 'mySchedulings'));
    }

    /**
     * Show the form for scheduling an assessment
     */
    public function schedule($assessmentId)
    {
        $assessment = RecordAssessment::with('discipline')->findOrFail($assessmentId);
        
        // Verificar se o período de agendamento ainda está aberto
        if (Carbon::parse($assessment->end_date)->lt(Carbon::today())) {
            return redirect()->route('student.assessments.index')
                ->with('alert', [
                    'icon' => 'error',
                    'title' => 'Período encerrado',
                    'text' => 'O período para agendar esta avaliação já terminou.'
                ]);
        }

        return view('student-assessments.schedule', compact('assessment'));
    }

    /**
     * Store the scheduling
     */
    public function store(Request $request)
    {
        $request->validate([
            'record_assessment_id' => 'required|exists:record_assessments,id',
            'scheduling_date' => 'required|date',
            'scheduling_time' => 'required',
        ]);

        $assessment = RecordAssessment::findOrFail($request->record_assessment_id);
        
        // Combinar data + hora
        $schedulingDateTime = Carbon::parse($request->scheduling_date . ' ' . $request->scheduling_time);
        $primaryDate = Carbon::parse($assessment->primary_date);
        $endDate = Carbon::parse($assessment->end_date)->endOfDay();

        // Validar se a data está dentro do período permitido
        if ($schedulingDateTime->lt($primaryDate) || $schedulingDateTime->gt($endDate)) {
            return back()->with('alert', [
                'icon' => 'error',
                'title' => 'Data inválida',
                'text' => 'A data deve estar entre ' . $primaryDate->format('d/m/Y') . ' e ' . $endDate->format('d/m/Y')
            ])->withInput();
        }

        // Verificar se o aluno já agendou esta avaliação (qualquer data)
        $existingScheduling = Scheduling::where('user_id', auth()->id())
            ->where('discipline_id', $assessment->discipline_id)
            ->first();

        if ($existingScheduling) {
            return back()->with('alert', [
                'icon' => 'warning',
                'title' => 'Agendamento duplicado',
                'text' => 'Você já possui um agendamento para esta disciplina.'
            ])->withInput();
        }

        // Verificar se já fez esta prova
        $hasCompleted = \DB::table('disc_sched')
            ->where('user_id', auth()->id())
            ->where('discipline_id', $assessment->discipline_id)
            ->whereNotNull('score')
            ->exists();

        if ($hasCompleted) {
            return back()->with('alert', [
                'icon' => 'info',
                'title' => 'Prova já realizada',
                'text' => 'Você já realizou a prova desta disciplina.'
            ])->withInput();
        }

        Scheduling::create([
            'user_id' => auth()->id(),
            'discipline_id' => $assessment->discipline_id,
            'scheduling' => $schedulingDateTime,
        ]);

        return redirect()->route('student.assessments.index')
            ->with('alert', [
                'icon' => 'success',
                'title' => 'Agendamento realizado!',
                'text' => 'Sua prova foi agendada para ' . $schedulingDateTime->format('d/m/Y às H:i') . '. Duração: 1 hora.'
            ]);
    }

    /**
     * Cancel a scheduling
     */
    public function cancel($schedulingId)
    {
        $scheduling = Scheduling::where('id', $schedulingId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Verificar se ainda é possível cancelar (não pode cancelar no dia da prova ou depois)
        if (Carbon::parse($scheduling->scheduling)->isPast() || Carbon::parse($scheduling->scheduling)->isToday()) {
            return back()->with('alert', [
                'icon' => 'error',
                'title' => 'Cancelamento não permitido',
                'text' => 'Não é possível cancelar agendamentos no dia da prova ou depois dela ter passado.'
            ]);
        }

        $disciplineName = $scheduling->discipline->name;
        $scheduling->delete();

        return redirect()->route('student.assessments.index')
            ->with('alert', [
                'icon' => 'success',
                'title' => 'Agendamento cancelado!',
                'text' => "A avaliação de {$disciplineName} está disponível para agendamento novamente."
            ]);
    }
}
