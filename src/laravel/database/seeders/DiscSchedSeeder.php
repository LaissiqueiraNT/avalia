<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscSchedSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('disc_sched')->insert([
            [
                'user_id' => 1,
                'discipline_id' => 2,
                'scheduling' => '2025-03-20 10:00:00',
                'address' => 'Rua das Flores, 225',
                'neighborhood' => 'Jardins',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
