<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\BlogLike;
use App\Models\Blog;
use App\Models\User;

class BlogLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userIds = User::pluck('id')->toArray();
        $blogIds = Blog::pluck('id')->toArray();


        $numberOfLikes = 50;

        for ($i = 0; $i < $numberOfLikes; $i++) {
            $userId = $userIds[array_rand($userIds)];
            $blogId = $blogIds[array_rand($blogIds)];

            BlogLike::firstOrCreate([
                'user_id' => $userId,
                'blog_id' => $blogId,
            ]);
        }
    }
}
