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
                'type_test' => 1, // A2
                'primary_date' => '2025-03-10',
                'end_date' => '2025-03-20',
                'hours' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'discipline_id' => 2,
                'type_test' => 2, // A3
                'primary_date' => '2025-04-01',
                'end_date' => '2025-04-15',
                'hours' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'discipline_id' => 3,
                'type_test' => 1, // A2
                'primary_date' => '2025-05-05',
                'end_date' => '2025-05-20',
                'hours' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
