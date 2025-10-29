<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => 'admin@idea.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'administrator',
                'status' => 'active',
            ]
        );
    }
}
