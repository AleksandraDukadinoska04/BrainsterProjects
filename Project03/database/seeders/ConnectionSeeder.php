<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Connection;
use App\Models\User;


class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $numberOfConnections = 40;

        $existingConnections = [];

        for ($i = 0; $i < $numberOfConnections; $i++) {
            do {
                $userId = $userIds[array_rand($userIds)];
                $friendId = $userIds[array_rand($userIds)];
            } while ($userId == $friendId || in_array([$userId, $friendId], $existingConnections) || in_array([$friendId, $userId], $existingConnections));


            $existingConnections[] = [$userId, $friendId];

            Connection::create([
                'user_id' => $userId,
                'friend_id' => $friendId,
                'status' => 'accepted'

            ]);
        }
    }
}
