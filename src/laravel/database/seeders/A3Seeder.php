<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class A3Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('a3')->insert([
            [
                'discipline_id' => 1,
                'question_response_id' => 1,
                'question_description_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'discipline_id' => 1,
                'question_response_id' => 1,
                'question_description_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
