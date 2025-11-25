<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class A2Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('a2')->insert([
            [
                'discipline_id' => 1,
                'question_response_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'discipline_id' => 1,
                'question_response_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
