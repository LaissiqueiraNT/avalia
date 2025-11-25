<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionResponseSeeder extends Seeder
{
    public function run(): void
    {
        // Pergunta 1: "Qual é a capital da França?"
        DB::table('question_response')->insert([
            ['question_id' => 1, 'response_id' => 1, 'score' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 1, 'response_id' => 2, 'score' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 1, 'response_id' => 3, 'score' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 1, 'response_id' => 4, 'score' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pergunta 2: "Quanto é 2 + 2?"
        DB::table('question_response')->insert([
            ['question_id' => 2, 'response_id' => 1, 'score' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 2, 'response_id' => 2, 'score' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 2, 'response_id' => 3, 'score' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 2, 'response_id' => 4, 'score' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
