<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $super_adminEmail = 'super-admin@example.com';
        $adminEmail = 'admin@example.com';
        $userEmail = "user@gmail.com";

        if(!User::where('email', $super_adminEmail && $adminEmail && $userEmail)->exists()) {
            User::create([
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'username' => 'super-admin',
                'email' => $super_adminEmail,
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'ticket_balance' => 0,
                'profile_completion_awarded' => true,
                'email_verified_at' => now(),
                'last_login_award_date' => now(),
                'date_of_birth' => null,
                'last_login_at' => now(),
                'joined_date' => now(),
            ]);
            User::create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'username' => 'admin-user',
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
            User::create([
                'first_name' => 'Test',
                'last_name' => 'User',
                'username' => 'test-user',
                'email' => $userEmail,
                'password' => Hash::make('password123'),
                'role_id' => 1,
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
