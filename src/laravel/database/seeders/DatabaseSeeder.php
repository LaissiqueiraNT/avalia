<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Lais Siqueira',
        //     'email' => 'laissiqueira366@gmail.com',
        //     'password' => bcrypt('Lais12345678@#'),
        //     'ra' => 'E34534',
        //     'type_user' => 1,
        // ]);
        User::factory()->create([
            'name' => 'Felipe',
            'email' => 'finkungalves@gmail.com',
            'password' => bcrypt('Felipe12345678@#'),
            'ra' => 'E67567',
            'type_user' => 1,
        ]);
        User::factory()->create([
            'name' => 'Lucas',
            'email' => 'lucasantosfelicio@gmail.com',
            'password' => bcrypt('Lucas12345678@#'),
            'ra' => 'E324234',
            'type_user' => 1,
        ]);
    }
}
