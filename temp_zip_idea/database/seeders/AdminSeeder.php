<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => ' admin',
            'email' => 'admin@idea.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
