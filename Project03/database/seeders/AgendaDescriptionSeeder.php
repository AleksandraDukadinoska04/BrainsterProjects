<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agenda;
use App\Models\AgendaDescription;
use Faker\Factory as Faker;


class AgendaDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $agendaIds = Agenda::pluck('id')->toArray();

        foreach ($agendaIds as $agendaId) {
            $numberOfDescriptions = rand(0, 3);

            for ($i = 0; $i < $numberOfDescriptions; $i++) {
                AgendaDescription::create([
                    'agenda_id' => $agendaId,
                    'description' => $faker->sentence(6),
                ]);
            }
        }
    }
}
