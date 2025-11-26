<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'question' => 'Qual é a capital da França?',
                'correct_response_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Quanto é 2 + 2?',
                'correct_response_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
