<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Ticket;
use App\Models\Event;



class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $eventIds = Event::pluck('id')->toArray();
        $ticketTypes = ['person', 'company'];
        foreach ($eventIds as $eventId) {
            foreach ($ticketTypes as $type) {
                Ticket::create([
                    'event_id' => $eventId,
                    'ticket_type' => $type,
                    'price'   => $faker->randomFloat(2, 5, 100),
                    'quantity' => $faker->numberBetween(30, 100),
                    'seats' =>  $faker->numberBetween(1, 10),
                    'pauses' => $faker->sentence(10),
                    'wifi' => $faker->boolean
                ]);
            }
        }
    }
}
