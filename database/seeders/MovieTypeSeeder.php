<?php

namespace Database\Seeders;

use App\Models\MovieType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovieType::create([
            'name' => 'Kiếm hiệp',
        ]);

        MovieType::create([
            'name' => 'Hành động',
        ]);

        MovieType::create([
            'name' => 'Ngôn tình, lãng mạn',
        ]);

        MovieType::create([
            'name' => 'Khoa học viễn tưởng',
        ]);

        MovieType::create([
            'name' => 'Kinh dị',
        ]);
    }
}