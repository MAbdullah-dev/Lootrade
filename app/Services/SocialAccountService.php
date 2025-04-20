<?php

namespace App\Services;

use App\Constants\SocialProviders;
use App\Models\User;
use App\Models\UserSocialAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SocialAccountService
{
    public function createOrGetUser($providerUser, string $provider): User
    {
        // Validate provider
        if (!in_array($provider, SocialProviders::all())) {
            throw new \InvalidArgumentException("Unsupported social provider: {$provider}");
        }

        return DB::transaction(function () use ($providerUser, $provider) {
            $email = $providerUser->email ?? null;
            $name = $providerUser->name ?? ($providerUser->nickname ?? 'User_' . Str::random(4));

            if (empty($email)) {
                Log::warning("Missing email for provider {$provider}, provider_id: {$providerUser->id}");
            }

            if (empty($name)) {
                Log::warning("Missing name for provider {$provider}, provider_id: {$providerUser->id}");
                $name = 'User_' . Str::random(4);
            }

            // Check if social account already exists
            $socialAccount = UserSocialAccount::where('provider', $provider)
                ->where('provider_id', $providerUser->id)
                ->first();

            if ($socialAccount && $socialAccount->user) {
                $socialAccount->update([
                    'provider_email' => $email,
                    'access_token' => $providerUser->token,
                    'refresh_token' => $providerUser->refreshToken,
                ]);
                return $socialAccount->user;
            }

            // Check if user exists by email
            $user = $email ? User::where('email', $email)->first() : null;
            $isNewUser = false;

            if (!$user) {
                $isNewUser = true;

                // Split full name
                $nameParts = explode(' ', $name, 2);
                $firstName = $nameParts[0] ?? '';
                $lastName = $nameParts[1] ?? '';

                // Generate username
                $baseUsername = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $name)) ?: 'user_' . Str::random(4);
                $username = $baseUsername;
                $counter = 1;

                while (User::where('username', $username)->exists()) {
                    $username = $baseUsername . '_' . $counter;

                    if (strlen($username) > 255) {
                        $username = substr($baseUsername, 0, 240) . '_' . $counter;
                    }

                    $counter++;
                }

                // Create user
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'username' => $username,
                    'email' => $email,
                    'password' => null,
                    'joined_date' => now(),
                    'role_id' => 1,
                    'ticket_balance' => 0,
                    'profile_completion_awarded' => false,
                    'last_login_award_date' => null,
                    'date_of_birth' => null,
                    'last_login_at' => now(),
                ]);
            }

            // Create or update social account
            $socialAccount = UserSocialAccount::updateOrCreate(
                [
                    'provider' => $provider,
                    'provider_id' => $providerUser->id,
                ],
                [
                    'user_id' => $user->id,
                    'provider_email' => $email,
                    'access_token' => $providerUser->token,
                    'refresh_token' => $providerUser->refreshToken,
                ]
            );

            // Handle rewards
            if ($isNewUser) {
                app('App\Services\TicketGenerationService')->generateTickets($user->id, 10, 'earned');
                $user->update([
                    'ticket_balance' => $user->ticket_balance + 10,
                ]);
            } else {
                app('App\Services\TicketGenerationService')->generateTickets($user->id, 10, 'earned');
                $user->update([
                    'ticket_balance' => $user->ticket_balance + 10,
                ]);
            }

            return $user;
        });
    }
}
