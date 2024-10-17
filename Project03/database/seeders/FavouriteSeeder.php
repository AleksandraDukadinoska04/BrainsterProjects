<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favourite;
use Faker\Factory as Faker;
use App\Models\Blog;
use App\Models\User;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $blogIds = Blog::pluck('id')->toArray();
        $numberOfFavorites = 100;

        for ($i = 0; $i < $numberOfFavorites; $i++) {
            $userId = $userIds[array_rand($userIds)];
            $blogId = $blogIds[array_rand($blogIds)];

            Favourite::firstOrCreate([
                'user_id' => $userId,
                'blog_id' => $blogId,
            ]);
        }
    }
}
