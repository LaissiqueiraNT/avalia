<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\DiscSched;
use Illuminate\Support\Facades\DB;

class GradesController extends Controller
{
    /**
     * Listar disciplinas com notas
     */
    public function index()
    {
        // Buscar disciplinas que têm avaliações registradas
        $disciplines = Discipline::whereHas('recordAssessments')
            ->orderBy('name')
            ->get();

        return view('grades.index', compact('disciplines'));
    }

    /**
     * Mostrar notas de uma disciplina específica
     */
    public function show($disciplineId)
    {
        $discipline = Discipline::findOrFail($disciplineId);

        // Buscar todas as notas da disciplina com informações do aluno e agendamento
        $grades = DB::table('disc_sched')
            ->join('users', 'disc_sched.user_id', '=', 'users.id')
            ->join('schedulings', 'disc_sched.scheduling_id', '=', 'schedulings.id')
            ->where('disc_sched.discipline_id', $disciplineId)
            ->whereNotNull('disc_sched.score')
            ->select(
                'disc_sched.id',
                'users.name as student_name',
                'users.email as student_email',
                'disc_sched.score',
                'schedulings.scheduling as exam_date',
                'disc_sched.created_at as submission_date'
            )
            ->orderBy('users.name')
            ->orderBy('schedulings.scheduling', 'desc')
            ->get();

        // Calcular estatísticas
        $statistics = [
            'total_students' => $grades->count(),
            'average_score' => $grades->avg('score'),
            'highest_score' => $grades->max('score'),
            'lowest_score' => $grades->min('score'),
            'pass_rate' => $grades->filter(fn($g) => $g->score >= 7)->count() / max($grades->count(), 1) * 100
        ];

        return view('grades.show', compact('discipline', 'grades', 'statistics'));
    }
}
