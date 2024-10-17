<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\BlogComment;
use App\Models\Blog;
use App\Models\User;

class BlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();
        $blogs = Blog::all();

        foreach ($blogs as $blog) {
            for ($i = 0; $i < 3; $i++) {
                $user = $users->random();

                $parentComment = BlogComment::create([
                    'user_id' => $user->id,
                    'blog_id' => $blog->id,
                    'content' => $faker->paragraph,
                    'parent_id' => null,
                ]);

                for ($j = 0; $j < 2; $j++) {
                    $replyUser = $users->random();

                    BlogComment::create([
                        'user_id' => $replyUser->id,
                        'blog_id' => $blog->id,
                        'content' => $faker->paragraph,
                        'parent_id' => $parentComment->id,
                    ]);
                }
            }
        }
    }
}
