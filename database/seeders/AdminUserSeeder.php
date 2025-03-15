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
            'name' => 'test123',
            'email' => 'test123@test.com',
            'password' => Hash::make('test123'),
            'is_admin' => true,
        ]);
    }
}
