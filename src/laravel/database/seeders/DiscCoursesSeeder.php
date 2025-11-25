<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscCoursesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('disc_courses')->insert([
            [
                'course_id' => 1,
                'discipline_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'discipline_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'discipline_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
