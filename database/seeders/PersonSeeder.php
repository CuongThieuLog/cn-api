<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Person::create([
            'name' => 'John Doe',
            'position' => 'Developer',
            'avatar' => 'https://example.com/avatar1.png',
            'date_of_birth' => '1990-05-15',
            'biography' => 'John Doe is a seasoned developer with 10 years of experience.',
        ]);

        Person::create([
            'name' => 'Jane Smith',
            'position' => 'Designer',
            'avatar' => 'https://example.com/avatar2.png',
            'date_of_birth' => '1985-08-20',
            'biography' => 'Jane Smith is a creative designer specializing in user experience.',
        ]);

        Person::create([
            'name' => 'Michael Brown',
            'position' => 'Manager',
            'avatar' => 'https://example.com/avatar3.png',
            'date_of_birth' => '1978-12-10',
            'biography' => 'Michael Brown oversees project management and client relations.',
        ]);

        Person::create([
            'name' => 'Emily Davis',
            'position' => 'Marketing Specialist',
            'avatar' => 'https://example.com/avatar4.png',
            'date_of_birth' => '1992-03-25',
            'biography' => 'Emily Davis excels in digital marketing strategies and campaigns.',
        ]);

        Person::create([
            'name' => 'William Johnson',
            'position' => 'Sales Representative',
            'avatar' => 'https://example.com/avatar5.png',
            'date_of_birth' => '1983-06-05',
            'biography' => 'William Johnson is passionate about sales and customer relationships.',
        ]);
    }
}
