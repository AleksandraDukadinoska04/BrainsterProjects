<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Event::create([
                'title_id'  =>  $faker->numberBetween(1, 4),
                'theme'        => $faker->sentence(10),
                'description' => $faker->paragraph,
                'objective'      => $faker->paragraph,
                'location' => $faker->address,
                'date' => $faker->date()

            ]);
        }
    }
}
