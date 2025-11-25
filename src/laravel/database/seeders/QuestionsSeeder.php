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
                'corret_response_id' => 2, // Opção B
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Quanto é 2 + 2?',
                'corret_response_id' => 3, // Opção C
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
