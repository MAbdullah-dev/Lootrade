<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Constants\SocialProviders;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    protected $socialAccountService;

    public function __construct(SocialAccountService $service)
    {
        $this->socialAccountService = $service;
    }

    public function redirectToProvider(string $provider)
    {
        if (!in_array($provider, SocialProviders::all())) {
            Log::error("Invalid provider requested: {$provider}");
            return redirect('/auth')->with('error', 'Invalid provider');
        }

        try {
            $driverName = $provider === 'twitter' ? 'twitter-oauth-2' : $provider;
            $config = config("services.{$driverName}");
            if (empty($config)) {
                Log::error("Configuration missing for provider: {$driverName}");
                return redirect('/auth')->with('error', 'Provider configuration not found');
            }
            $driver = Socialite::driver($driverName);
            if ($provider === 'twitter') {
                $driver->scopes(['users.read', 'tweet.read', 'offline.access']);
                Log::debug("Twitter redirect initiated with scopes: users.read, tweet.read, offline.access");
            }
            return $driver->redirect();
        } catch (\Exception $e) {
            Log::error("Socialite redirect failed for {$provider}: {$e->getMessage()}", [
                'exception' => $e,
                'config' => config("services.{$driverName}"),
            ]);
            return redirect('/auth')->with('error', 'Failed to redirect to ' . ucfirst($provider));
        }
    }

    public function handleProviderCallback(string $provider)
    {
        if (!in_array($provider, SocialProviders::all())) {
            Log::error("Invalid provider callback: {$provider}");
            return redirect('/auth')->with('error', 'Invalid provider');
        }

        try {
            $driverName = $provider === 'twitter' ? 'twitter-oauth-2' : $provider;
            $config = config("services.{$driverName}");
            if (empty($config)) {
                Log::error("Configuration missing for provider: {$driverName}");
                return redirect('/auth')->with('error', 'Provider configuration not found');
            }
            $driver = Socialite::driver($driverName);
            $providerUser = $driver->user();
            Log::debug("Callback for {$provider} received user data: " . json_encode([
                'id' => $providerUser->id,
                'email' => $providerUser->email,
                'name' => $providerUser->name,
            ]));
            $user = $this->socialAccountService->createOrGetUser($providerUser, $provider);
            $user->update(['last_login_at' => now()]);
            Auth::login($user);
            return redirect('/home')->with('success', 'Logged in successfully via ' . ucfirst($provider) . '!');
        } catch (\Exception $e) {
            Log::error("Socialite authentication failed for {$provider}: {$e->getMessage()}", [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect('/auth')->with('error', 'Authentication failed. Please try again.');
        }
    }
}
