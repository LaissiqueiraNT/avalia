<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordAssessmentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('record_assessments')->insert([
            [
                'discipline_id' => 1,
                'primary_date' => '2025-03-10',
                'end_date' => '2025-03-20',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
