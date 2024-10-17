<?php

namespace Database\Seeders;

use App\Models\EventTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = ['HR Кафе', 'HR Викенд', 'HR Вебинар', 'HR Конференции'];

        foreach ($titles as $title) {
            EventTitle::create([
                'title' => $title
            ]);
        }
    }
}
