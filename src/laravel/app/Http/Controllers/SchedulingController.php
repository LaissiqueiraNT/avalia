<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecordAssessment;
use App\Models\Scheduling;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class SchedulingController extends Controller
{
      public function index()
    {
        $userId = auth()->id();

        // pegar os cursos que o aluno está matriculado (via pivot)
        $userCourses = DB::table('enrollment')
            ->where('user_id', $userId)
            ->pluck('course_id');

        // pegar avaliações ativas relacionadas a matérias dos cursos do aluno
        $avaliacoes = RecordAssessment::with('discipline')
            ->whereIn('discipline_id', function ($query) use ($userCourses) {
                $query->select('id')
                    ->from('disciplines')
                    ->whereIn('course_id', $userCourses);
            })
            ->whereDate('primary_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        return view('scheduling.index-scheduling', compact('avaliacoes'));
    }


    public function create($assessmentId)
    {
        $assessment = RecordAssessment::with('discipline')->findOrFail($assessmentId);

        return view('scheduling.crud-scheduling', compact('assessment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assessment_id' => 'required',
            'scheduling' => 'required|date',
            'address' => 'required',
            'neighborhood' => 'required',
        ]);

        $assessment = RecordAssessment::with('discipline')->find($request->assessment_id);

        if (!($request->scheduling >= $assessment->primary_date &&
            $request->scheduling <= $assessment->end_date))
        {
            return back()->with('alert', [
                'icon' => 'error',
                'title' => 'A data escolhida está fora do período permitido.'
            ]);
        }

        Scheduling::create([
            'user_id' => auth()->id(),
            'discipline_id' => $assessment->discipline_id,
            'scheduling' => $request->scheduling,
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
        ]);

        return redirect()->route('student.scheduling.index')->with('alert', [
            'icon' => 'success',
            'title' => 'Prova agendada com sucesso!'
        ]);
    }
}
