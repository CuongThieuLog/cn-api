<?php

namespace Database\Seeders;

use App\Models\MovieFormat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovieFormat::create([
            'name' => '2D',
        ]);

        MovieFormat::create([
            'name' => '3D',
        ]);

        MovieFormat::create([
            'name' => '4D',
        ]);

        MovieFormat::create([
            'name' => '5D',
        ]);
    }
}