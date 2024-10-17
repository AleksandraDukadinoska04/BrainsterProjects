<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Speaker;

class SpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Speaker::create([
                'name'  => $faker->firstName,
                'surname'   => $faker->lastName,
                'profession' => $faker->jobTitle,
                'img'      => 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg',
                'linkedin' => $faker->url,
                'facebook' => $faker->url,
                'instagram' => $faker->url,
                'twitter' => $faker->url,

            ]);
        }
    }
}
