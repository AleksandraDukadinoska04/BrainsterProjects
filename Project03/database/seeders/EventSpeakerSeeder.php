<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\EventSpeaker;
use App\Models\Event;
use App\Models\Speaker;

class EventSpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $eventIds = Event::pluck('id')->toArray();
        $speakerIds = Speaker::pluck('id')->toArray();
        $existingPairs = [];
        $numberOfAssociations = 50;

        for ($i = 0; $i < $numberOfAssociations; $i++) {
            do {
                $eventId = $eventIds[array_rand($eventIds)];
                $speakerId = $speakerIds[array_rand($speakerIds)];
                $pair = $eventId . '-' . $speakerId;
            } while (in_array($pair, $existingPairs));

            $existingPairs[] = $pair;

            EventSpeaker::create([
                'event_id' => $eventId,
                'speaker_id' => $speakerId,
                'speaker_type' =>  $faker->randomElement(['special', 'ordinary']),
                'speaker_invitation'   => $faker->paragraph()
            ]);
        }
    }
}
