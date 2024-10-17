<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\BroughtTicket;
use App\Models\User;
use App\Models\Ticket;

class BroughtTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $ticketIds = Ticket::pluck('id')->toArray();
        $numberOfTicketsPerUser = 3;

        foreach ($userIds as $userId) {
            $ticketsToBuy = array_rand(array_flip($ticketIds), min($numberOfTicketsPerUser, count($ticketIds)));

            foreach ($ticketsToBuy as $ticketId) {
                BroughtTicket::firstOrCreate([
                    'user_id' => $userId,
                    'ticket_id' => $ticketId,
                ]);
            }
        }
    }
}
