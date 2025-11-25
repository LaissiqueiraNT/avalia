<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponsesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('responses')->insert([
            ['response' => 'Opção A', 'created_at' => now(), 'updated_at' => now()],
            ['response' => 'Opção B', 'created_at' => now(), 'updated_at' => now()],
            ['response' => 'Opção C', 'created_at' => now(), 'updated_at' => now()],
            ['response' => 'Opção D', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
