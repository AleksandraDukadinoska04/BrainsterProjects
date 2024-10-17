<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Employee::create([
                'name'  => $faker->firstName,
                'surname'   => $faker->lastName,
                'bio'        => $faker->paragraph,
                'profession' => $faker->jobTitle,
                'img'      => 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg',
                'facebook' => $faker->url,
                'instagram' => $faker->url,
                'twitter' => $faker->url,
                'linkedin' => $faker->url,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
