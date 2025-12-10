<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Response;
use App\Models\A2;
use App\Models\Discipline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Buscar todas as disciplinas
        $disciplines = Discipline::all();

        foreach ($disciplines as $discipline) {
            // Criar 10 questões para cada disciplina
            for ($i = 1; $i <= 10; $i++) {
                // Criar a questão
                $question = DB::table('questions')->insertGetId([
                    'question' => "Questão {$i} de {$discipline->name} - Exemplo de questão de múltipla escolha",
                    'correct_response_id' => 1, // Temporário, será atualizado
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Criar 3 respostas (A, B, C)
                $responses = [];
                $correctResponseId = null;

                foreach (['A', 'B', 'C'] as $index => $option) {
                    $responseId = DB::table('responses')->insertGetId([
                        'response' => "Opção {$option} - Questão {$i}",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $responses[] = $responseId;

                    // Primeira opção será a correta
                    if ($index === 0) {
                        $correctResponseId = $responseId;
                    }

                    // Relacionar questão com resposta
                    $questionResponseId = DB::table('question_response')->insertGetId([
                        'question_id' => $question,
                        'response_id' => $responseId,
                        'score' => $index === 0 ? 1.0 : 0.0, // Apenas a primeira tem score 1
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Atualizar a questão com a resposta correta
                DB::table('questions')
                    ->where('id', $question)
                    ->update(['correct_response_id' => $correctResponseId]);

                // Vincular à disciplina via A2
                DB::table('a2')->insert([
                    'discipline_id' => $discipline->id,
                    'question_response_id' => DB::table('question_response')
                        ->where('question_id', $question)
                        ->where('score', 1.0)
                        ->first()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
