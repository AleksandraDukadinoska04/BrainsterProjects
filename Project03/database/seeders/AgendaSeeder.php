<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Agenda;
use App\Models\Event;


class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $eventIds = Event::pluck('id')->toArray();

        foreach ($eventIds as $eventId) {

            for ($i = 1; $i <= 8; $i++) {
                Agenda::create([
                    'event_id' => $eventId,
                    'day' => rand(1, 2),
                    'hour' => rand(8, 17) . ':00',
                    'title' => $faker->sentence(6),
                ]);
            }
        }
    }
}
