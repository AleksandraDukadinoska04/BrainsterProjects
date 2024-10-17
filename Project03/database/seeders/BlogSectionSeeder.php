<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\BlogSection;

class BlogSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            for ($x = 1; $x <= 3; $x++) {

                BlogSection::create([
                    'blog_id' =>  $i,
                    'order' =>  $x,
                    'section_title' => $faker->sentence(6),
                    'section_content' => $faker->paragraph(),
                ]);
            }
        }
    }
}
