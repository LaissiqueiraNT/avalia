<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->insert([
    ['name' => 'Engenharia de Software', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Sistemas de Informação', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Redes de Computadores', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Ciência da Computação', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Análise e Desenvolvimento de Sistemas', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Gestão da Tecnologia da Informação', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Banco de Dados', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Inteligência Artificial', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Segurança da Informação', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Engenharia de Computação', 'created_at' => now(), 'updated_at' => now()],
]);

    }
}
