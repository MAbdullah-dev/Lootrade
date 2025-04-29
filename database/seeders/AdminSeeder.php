<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = 'admin@example.com';

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'username' => 'admin',
                'email' => $adminEmail,
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'ticket_balance' => 0,
                'profile_completion_awarded' => true,
                'email_verified_at' => now(),
                'last_login_award_date' => now(),
                'date_of_birth' => null,
                'last_login_at' => now(),
                'joined_date' => now(),
            ]);
        }
    }
}
