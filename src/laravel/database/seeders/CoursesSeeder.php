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
        ]);
    }
}
