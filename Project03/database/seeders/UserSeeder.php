<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        User::create([
            'name'  => $faker->firstName,
            'surname'   => $faker->lastName,
            'bio' => $faker->paragraph,
            'profession' => $faker->jobTitle,
            'phone' => $faker->phoneNumber,
            'city' => $faker->city,
            'country' => $faker->country,
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        User::factory()->count(10)->create();
    }
}
