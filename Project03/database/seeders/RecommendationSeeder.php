<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Recommendation;
use App\Models\User;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $userIds = User::pluck('id')->toArray();
        $numberOfRecommendations = 50;

        for ($i = 0; $i < $numberOfRecommendations; $i++) {
            do {
                $fromUserId = $userIds[array_rand($userIds)];
                $forUserId = $userIds[array_rand($userIds)];
            } while ($fromUserId == $forUserId);

            Recommendation::create([
                'from_user_id' => $fromUserId,
                'for_user_id' => $forUserId,
                'content' => $faker->paragraph
            ]);
        }
    }
}
