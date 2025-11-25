<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionDescriptionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('question_descriptions')->insert([
            [
                'question' => 'Explique o que é um algoritmo.',
                'response' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Descreva a importância da segurança da informação.',
                'response' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
