<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Lais Siqueira',
            'email' => 'laissiqueira366@gmail.com',
            'password' => bcrypt('Lais12345678@#'),
            'ra' => 'E34534',
            'type_user' => 1,
        ]);
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
        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 10; $i++) {
            User::factory()->create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('SenhaForte123@'),
                'ra' => 'RA' . rand(100000, 999999),
                'type_user' => 2,
            ]);
        }

        $this->call([
            CoursesSeeder::class,
            DisciplinesSeeder::class,
            DiscCoursesSeeder::class,
            EnrollmentSeeder::class,
            SchedulingsSeeder::class,
            DiscSchedSeeder::class,
            ResponsesSeeder::class,
            QuestionsSeeder::class,
            QuestionResponseSeeder::class,
            QuestionDescriptionsSeeder::class,
            A2Seeder::class,
            A3Seeder::class,
            RecordAssessmentsSeeder::class,
        ]);
    }
}
