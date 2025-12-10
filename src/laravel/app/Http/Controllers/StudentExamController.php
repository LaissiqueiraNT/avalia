<?php

namespace App\Http\Controllers;

use App\Models\Scheduling;
use App\Models\A2;
use App\Models\DiscSched;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentExamController extends Controller
{
    /**
     * Mostrar a prova para o aluno fazer
     */
    public function show($schedulingId)
    {
        $scheduling = Scheduling::with(['discipline', 'assessment'])->findOrFail($schedulingId);
        
        // Verificar se é o aluno dono do agendamento
        if ($scheduling->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para acessar esta prova.');
        }

        // Verificar se o agendamento tem uma avaliação vinculada
        if (!$scheduling->assessment) {
            return redirect()->route('student.assessments.index')
                ->with('alert', [
                    'icon' => 'error',
                    'title' => 'Avaliação não encontrada',
                    'text' => 'Esta prova não está mais disponível.'
                ]);
        }

        // Verificar se já fez a prova (verificar pelo scheduling_id específico)
        $existingResult = DiscSched::where('scheduling_id', $schedulingId)
            ->where('user_id', auth()->id())
            ->whereNotNull('score')
            ->first();

        if ($existingResult) {
            return redirect()->route('student.exam.result', $schedulingId)
                ->with('info', 'Você já realizou esta prova!');
        }

        // Buscar as 10 questões da disciplina via A2
        $questionsData = DB::table('a2')
            ->join('question_response', 'a2.question_response_id', '=', 'question_response.id')
            ->join('questions', 'question_response.question_id', '=', 'questions.id')
            ->where('a2.discipline_id', $scheduling->discipline_id)
            ->select('questions.id', 'questions.question', 'question_response.question_id')
            ->distinct()
            ->limit(10)
            ->get();

        // Para cada questão, buscar suas 3 respostas
        $questions = [];
        foreach ($questionsData as $q) {
            $responses = DB::table('question_response')
                ->join('responses', 'question_response.response_id', '=', 'responses.id')
                ->where('question_response.question_id', $q->id)
                ->select('responses.id', 'responses.response', 'question_response.score')
                ->get();

            $questions[] = [
                'id' => $q->id,
                'question' => $q->question,
                'responses' => $responses
            ];
        }

        return view('student-exam.show', compact('scheduling', 'questions'));
    }

    /**
     * Submeter as respostas da prova
     */
    public function submit(Request $request, $schedulingId)
    {
        $scheduling = Scheduling::with(['discipline'])->findOrFail($schedulingId);
        
        // Verificar se é o aluno dono do agendamento
        if ($scheduling->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para submeter esta prova.');
        }

        // Verificar se já fez a prova (pelo scheduling_id)
        $existingResult = DiscSched::where('scheduling_id', $schedulingId)
            ->where('user_id', auth()->id())
            ->whereNotNull('score')
            ->first();

        if ($existingResult) {
            return redirect()->route('student.exam.result', $schedulingId)
                ->with('error', 'Você já realizou esta prova!');
        }

        // Calcular a nota
        $totalScore = 0;
        $correctAnswers = 0;
        $answers = $request->input('answers', []);

        foreach ($answers as $questionId => $responseId) {
            // Buscar o score da resposta
            $score = DB::table('question_response')
                ->where('question_id', $questionId)
                ->where('response_id', $responseId)
                ->value('score');

            if ($score > 0) {
                $totalScore += $score;
                $correctAnswers++;
            }
        }

        // Atualizar ou criar o registro em disc_sched com a nota
        DiscSched::updateOrCreate(
            [
                'scheduling_id' => $schedulingId,
                'user_id' => auth()->id(),
            ],
            [
                'discipline_id' => $scheduling->discipline_id,
                'scheduling' => $scheduling->scheduling,
                'score' => $totalScore,
                'address' => $scheduling->address ?? null,
                'neighborhood' => $scheduling->neighborhood ?? null,
            ]
        );

        return redirect()->route('student.exam.result', $schedulingId)
            ->with('success', 'Prova enviada com sucesso!');
    }

    /**
     * Mostrar o resultado da prova
     */
    public function result($schedulingId)
    {
        $scheduling = Scheduling::with(['discipline'])->findOrFail($schedulingId);
        
        // Verificar se é o aluno dono do agendamento
        if ($scheduling->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para ver este resultado.');
        }

        // Buscar o resultado pelo scheduling_id
        $result = DiscSched::where('scheduling_id', $schedulingId)
            ->where('user_id', auth()->id())
            ->whereNotNull('score')
            ->firstOrFail();

        return view('student-exam.result', compact('scheduling', 'result'));
    }
}
