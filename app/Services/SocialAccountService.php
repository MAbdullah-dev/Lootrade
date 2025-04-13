<?php
namespace App\Services;

use App\Constants\SocialProviders;
use App\Models\User;
use App\Models\UserSocialAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SocialAccountService
{
    public function createOrGetUser($providerUser, string $provider): User
    {
        //ensuring whether the provider is valid
        if (!in_array($provider, SocialProviders::all())) {
            throw new \InvalidArgumentException("Unsupported social provider: {$provider}");
        }

        //try to grab email and name from provider
        $email = $providerUser->email ?? null;
        $name = $providerUser->name ?? ($providerUser->nickname ?? 'User_' . Str::random(4));

        if (empty($email)) {
            Log::warning("Missing email for provider {$provider}, provider_id: {$providerUser->id}");
        }

        if (empty($name)) {
            Log::warning("Missing name for provider {$provider}, provider_id: {$providerUser->id}");
            $name = 'User_' . Str::random(4);
        }

        //checking if social account already exists
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

        //looking for existing user by email
        $user = $email ? User::where('email', $email)->first() : null;

        if (!$user) {
            //full name into first/last
            $nameParts = explode(' ', $name, 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';

            //generate a unique username
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

            //creating the user
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

        //creating/updating the social account with a valid user_id
        UserSocialAccount::updateOrCreate(
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

        return $user;
    }
}
