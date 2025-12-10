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
        
        // Buscar agendamentos já feitos pelo aluno (com assessment vinculado)
        $mySchedulings = Scheduling::with(['discipline', 'assessment'])
            ->where('user_id', $userId)
            ->whereNotNull('assessment_id') // Apenas agendamentos com avaliação vinculada
            ->orderBy('scheduling', 'desc')
            ->get();

        // IDs de disciplinas que o aluno já agendou (independente se fez ou não)
        // Removemos da lista de disponíveis TODAS as disciplinas já agendadas
        $scheduledDisciplineIds = $mySchedulings
            ->pluck('discipline_id')
            ->unique()
            ->toArray();

        // Buscar avaliações disponíveis (dentro do período) 
        // EXCLUINDO todas as disciplinas que o aluno já tem agendamento
        $availableAssessments = RecordAssessment::with('discipline')
            ->where('end_date', '>=', Carbon::today())
            ->whereNotIn('discipline_id', $scheduledDisciplineIds)
            ->get();

        return view('student-assessments.index', compact('availableAssessments', 'mySchedulings'));
    }

    /**
     * Show the form for scheduling an assessment
     */
   public function schedule($assessmentId)
{
    $assessment = RecordAssessment::with('discipline')->findOrFail($assessmentId);

    if (Carbon::parse($assessment->end_date)->lt(Carbon::today())) {
        return redirect()->route('student.assessments.index')
            ->with('alert', [
                'icon' => 'error',
                'title' => 'Período encerrado',
                'text' => 'O período para agendar esta avaliação já terminou.'
            ]);
    }

    $start = Carbon::parse($assessment->primary_date);
    $end = Carbon::parse($assessment->end_date);

    $availableDates = [];

    while ($start->lte($end)) {
        $availableDates[] = [
            'value' => $start->format('Y-m-d'),
            'label' => $start->format('d/m/Y'),
        ];

        $start->addDay();
    }

    return view('student-assessments.schedule', compact('assessment', 'availableDates'));
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

        // Verificar se o aluno já tem um agendamento ATIVO (ainda não realizado) para esta disciplina
        $existingSchedulings = Scheduling::where('user_id', auth()->id())
            ->where('discipline_id', $assessment->discipline_id)
            ->get();

        foreach ($existingSchedulings as $scheduling) {
            // Verificar se já completou essa tentativa pelo scheduling_id
            $completed = \DB::table('disc_sched')
                ->where('scheduling_id', $scheduling->id)
                ->where('user_id', auth()->id())
                ->whereNotNull('score')
                ->exists();
            
            // Se existe um agendamento que ainda não foi completado, não permitir
            if (!$completed) {
                return back()->with('alert', [
                    'icon' => 'warning',
                    'title' => 'Agendamento ativo encontrado',
                    'text' => 'Você já possui um agendamento pendente para esta disciplina.'
                ])->withInput();
            }
        }

        Scheduling::create([
            'user_id' => auth()->id(),
            'discipline_id' => $assessment->discipline_id,
            'assessment_id' => $assessment->id, // Vincular à avaliação específica
            'scheduling' => $schedulingDateTime,
        ]);

        // Formatar duração
        $totalMinutes = $assessment->hours ?? 120;
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        $duration = '';
        if ($hours > 0) {
            $duration .= $hours . 'h';
        }
        if ($minutes > 0) {
            $duration .= ($hours > 0 ? ' e ' : '') . $minutes . 'min';
        }
        $duration = $duration ?: '2h';

        return redirect()->route('student.assessments.index')
            ->with('alert', [
                'icon' => 'success',
                'title' => 'Agendamento realizado!',
                'text' => 'Sua prova foi agendada para ' . $schedulingDateTime->format('d/m/Y às H:i') . '. Duração: ' . $duration . '.'
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
