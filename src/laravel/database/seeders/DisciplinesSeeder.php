<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplinesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('disciplines')->insert([
            [
                'name' => 'Algoritmos',
                'teacher_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Banco de Dados',
                'teacher_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Segurança da Informação',
                'teacher_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
