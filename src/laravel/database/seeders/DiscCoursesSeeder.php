<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscCoursesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Engenharia de Software
            [ 'course_id' => 1, 'discipline_id' => 1 ],
            [ 'course_id' => 1, 'discipline_id' => 2 ],
            [ 'course_id' => 1, 'discipline_id' => 7 ],
            [ 'course_id' => 1, 'discipline_id' => 3 ],

            // Sistemas de Informação
            [ 'course_id' => 2, 'discipline_id' => 1 ],
            [ 'course_id' => 2, 'discipline_id' => 2 ],
            [ 'course_id' => 2, 'discipline_id' => 3 ],
            [ 'course_id' => 2, 'discipline_id' => 9 ],

            // Redes de Computadores
            [ 'course_id' => 3, 'discipline_id' => 5 ],
            [ 'course_id' => 3, 'discipline_id' => 6 ],
            [ 'course_id' => 3, 'discipline_id' => 9 ],

            // Ciência da Computação
            [ 'course_id' => 4, 'discipline_id' => 1 ],
            [ 'course_id' => 4, 'discipline_id' => 2 ],
            [ 'course_id' => 4, 'discipline_id' => 5 ],
            [ 'course_id' => 4, 'discipline_id' => 8 ],
            [ 'course_id' => 4, 'discipline_id' => 10 ],

            // ADS
            [ 'course_id' => 5, 'discipline_id' => 1 ],
            [ 'course_id' => 5, 'discipline_id' => 2 ],
            [ 'course_id' => 5, 'discipline_id' => 3 ],

            // GTI
            [ 'course_id' => 6, 'discipline_id' => 3 ],
            [ 'course_id' => 6, 'discipline_id' => 6 ],
            [ 'course_id' => 6, 'discipline_id' => 9 ],

            // Banco de Dados
            [ 'course_id' => 7, 'discipline_id' => 3 ],
            [ 'course_id' => 7, 'discipline_id' => 4 ],
            [ 'course_id' => 7, 'discipline_id' => 8 ],

            // Inteligência Artificial
            [ 'course_id' => 8, 'discipline_id' => 1 ],
            [ 'course_id' => 8, 'discipline_id' => 2 ],
            [ 'course_id' => 8, 'discipline_id' => 8 ],
            [ 'course_id' => 8, 'discipline_id' => 10 ],

            // Segurança da Informação
            [ 'course_id' => 9, 'discipline_id' => 6 ],
            [ 'course_id' => 9, 'discipline_id' => 9 ],
            [ 'course_id' => 9, 'discipline_id' => 5 ],

            // Engenharia de Computação
            [ 'course_id' => 10, 'discipline_id' => 1 ],
            [ 'course_id' => 10, 'discipline_id' => 2 ],
            [ 'course_id' => 10, 'discipline_id' => 6 ],
            [ 'course_id' => 10, 'discipline_id' => 10 ],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = now();
            $row['updated_at'] = now();
        }

        DB::table('disc_courses')->insert($data);
    }
}
