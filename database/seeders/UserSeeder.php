<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure roles exist
        $roles = ['super-admin', 'admin', 'user'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Seed users individually if they don't exist
        if (!User::where('email', 'super-admin@example.com')->exists()) {
            $user = User::create([
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'username' => 'super-admin',
                'email' => 'super-admin@example.com',
                'password' => Hash::make('password123'),
                'ticket_balance' => 0,
                'profile_completion_awarded' => true,
                'email_verified_at' => now(),
                'last_login_award_date' => now(),
                'date_of_birth' => null,
                'last_login_at' => now(),
                'joined_date' => now(),
            ]);
            $user->assignRole('super-admin');
        }

        if (!User::where('email', 'admin@example.com')->exists()) {
            $user = User::create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'username' => 'admin-user',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'ticket_balance' => 0,
                'profile_completion_awarded' => true,
                'email_verified_at' => now(),
                'last_login_award_date' => now(),
                'date_of_birth' => null,
                'last_login_at' => now(),
                'joined_date' => now(),
            ]);
            $user->assignRole('admin');
        }

        if (!User::where('email', 'user@gmail.com')->exists()) {
            $user = User::create([
                'first_name' => 'Test',
                'last_name' => 'User',
                'username' => 'test-user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password123'),
                'ticket_balance' => 0,
                'profile_completion_awarded' => true,
                'email_verified_at' => now(),
                'last_login_award_date' => now(),
                'date_of_birth' => null,
                'last_login_at' => now(),
                'joined_date' => now(),
            ]);
            $user->assignRole('user');
        }
    }
}
