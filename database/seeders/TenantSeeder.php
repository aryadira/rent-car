<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::create([
            'no_ktp' => '1234567890123456',
            'name' => 'Tenant 1',
            'date_of_birth' => Carbon::createFromFormat('d-m-Y', '20-03-2005')->format('Y-m-d'),
            'email' => 'tenant1@example.com',
            'phone' => '08123456789',
            'description' => 'Description for Tenant 1',
        ]);

        Tenant::create([
            'no_ktp' => '9876543210987654',
            'name' => 'Tenant 2',
            'date_of_birth' => Carbon::createFromFormat('d-m-Y', '15-04-1985')->format('Y-m-d'),
            'email' => 'tenant2@example.com',
            'phone' => '08234567890',
            'description' => 'Description for Tenant 2',
        ]);

        Tenant::create([
            'no_ktp' => '2345678901234567',
            'name' => 'Tenant 3',
            'date_of_birth' => Carbon::createFromFormat('d-m-Y', '10-11-1992')->format('Y-m-d'),
            'email' => 'tenant3@example.com',
            'phone' => '08345678901',
            'description' => 'Description for Tenant 3',
        ]);

        Tenant::create([
            'no_ktp' => '3456789012345678',
            'name' => 'Tenant 4',
            'date_of_birth' => Carbon::createFromFormat('d-m-Y', '25-08-1990')->format('Y-m-d'),
            'email' => 'tenant4@example.com',
            'phone' => '08456789012',
            'description' => 'Description for Tenant 4',
        ]);

        Tenant::create([
            'no_ktp' => '4567890123456789',
            'name' => 'Tenant 5',
            'date_of_birth' => Carbon::createFromFormat('d-m-Y', '12-07-1995')->format('Y-m-d'),
            'email' => 'tenant5@example.com',
            'phone' => '08567890123',
            'description' => 'Description for Tenant 5',
        ]);
    }
}
