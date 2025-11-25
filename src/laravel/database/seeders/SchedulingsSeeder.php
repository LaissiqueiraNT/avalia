<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('schedulings')->insert([
            [
                'user_id' => 1,
                'discipline_id' => 1,
                'scheduling' => '2025-03-15 14:00:00',
                'address' => 'Rua Principal, 123',
                'neighborhood' => 'Centro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
