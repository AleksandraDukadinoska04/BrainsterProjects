<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\GeneralInfo;

class GeneralInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        GeneralInfo::create([
            'hero_image'   => 'https://www.firstlinepharma.co.uk/wp-content/uploads/2020/02/Firstline-Pharma-MHRA-.png',
            'hero_title' =>   'Луѓето пред се!',
            'logo' => 'https://mhraconference.mk/wp-content/uploads/2024/09/Logo_Ispis-3.png-3.png',
            'email'   => 'contact@mhra.com',
            'address' =>  'Бул. ВМРО бр. 7/1-7 1000 Скопје, Македонија',
            'facebook' => 'https://www.facebook.com/mhra.mk',
            'instagram' => 'https://www.facebook.com/mhra.mk',
            'youtube' => 'https://www.facebook.com/mhra.mk',
            'linkedin' => 'https://www.facebook.com/mhra.mk',

        ]);
    }
}
