<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\CommentLike;
use App\Models\BlogComment;
use App\Models\User;

class CommentLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $commentIds = BlogComment::whereNull('parent_id')->pluck('id')->toArray();
        $numberOfLikes = 100;

        for ($i = 0; $i < $numberOfLikes; $i++) {
            $userId = $userIds[array_rand($userIds)];
            $commentId = $commentIds[array_rand($commentIds)];

            CommentLike::firstOrCreate([
                'user_id' => $userId,
                'blog_comment_id' => $commentId,
            ]);
        }
    }
}
