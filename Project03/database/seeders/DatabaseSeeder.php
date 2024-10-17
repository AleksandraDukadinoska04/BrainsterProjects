<?php

namespace Database\Seeders;

use App\Models\BlogLike;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            EventTitleSeeder::class,
            BlogSeeder::class,
            BlogSectionSeeder::class,
            BlogLikesSeeder::class,
            BlogCommentSeeder::class,
            CommentLikeSeeder::class,
            FavouriteSeeder::class,
            EventSeeder::class,
            AgendaSeeder::class,
            AgendaDescriptionSeeder::class,
            SpeakerSeeder::class,
            EventSpeakerSeeder::class,
            TicketSeeder::class,
            BroughtTicketSeeder::class,
            EmployeeSeeder::class,
            FeedbackSeeder::class,
            RecommendationSeeder::class,
            ConnectionSeeder::class,
            GeneralInfoSeeder::class,

        ]);
    }
}
