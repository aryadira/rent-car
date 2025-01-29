<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            // 'fullname' => 'Admin Rental',
            'username' => 'admin_rental',
            'password' => Hash::make('12345678'),
            // 'email' => 'admin1@gmail.com',
            // 'role' => 'admin'
        ]);

        // User::create([
        //     'fullname' => 'Arya Dira',
        //     'username' => 'aryadira',
        //     'email' => 'aryadira@gmail.com',
        //     // 'password' => Hash::make('12345678'),
        //     'role' => 'tenant'
        // ]);
    }
}
