<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin_cn',
            'email' => 'admin_cn@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => User::ROLE['ADMIN'],
            'is_active' => true,
        ]);

        User::create([
            'name' => 'manager_cn',
            'email' => 'manager_cn@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => User::ROLE['MANAGER'],
            'is_active' => true,
        ]);

        User::create([
            'name' => 'staff_cn',
            'email' => 'staff_cn@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => User::ROLE['STAFF'],
            'is_active' => true,
        ]);

        User::create([
            'name' => 'cuongthieu',
            'email' => 'thieutrancuong@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => User::ROLE['USER'],
            'is_active' => true,
        ]);
    }
}
