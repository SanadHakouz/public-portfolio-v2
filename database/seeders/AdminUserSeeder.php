<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'sanadhakouz@ymail.com',
            'password' => Hash::make('Adiga564!'),
            'is_admin' => true,
        ]);
    }
}
