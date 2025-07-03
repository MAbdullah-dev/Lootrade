<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Constants\SocialProviders;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        if (! in_array($provider, SocialProviders::all())) {
            Log::error("Invalid provider requested: {$provider}");
            return redirect('/auth')->with('error', 'Invalid provider');
        }

        // ─── KICK: Just build the /oauth/authorize URL and redirect ───
        if ($provider === 'kick') {
        $codeVerifier = $this->generateCodeVerifier();
        $codeChallenge = $this->generateCodeChallenge($codeVerifier);
        $state = $this->generateState();

        session([
            'kick_oauth_state' => $state,
            'kick_code_verifier' => $codeVerifier,
        ]);

        Log::debug('Kick callback state received:', ['state' => $state]);

        $query = http_build_query([
            'client_id' => config('services.kick.client_id'),
            'redirect_uri' => config('services.kick.redirect'),
            'response_type' => 'code',
            'scope' => 'user:read',
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
        ]);

        Log::debug('Redirecting to Kick URL:', [
        'url' => "https://id.kick.com/oauth/authorize?$query"
        ]);


        return redirect("https://id.kick.com/oauth/authorize?$query");
    }

        // ─── All other providers use Socialite ───
        try {
            $driverName = $provider === 'twitter'
                ? 'twitter-oauth-2'
                : $provider;

            $driver = Socialite::driver($driverName);

            if ($provider === 'twitter') {
                $driver->scopes(['users.read', 'tweet.read', 'offline.access']);
            }

            return $driver->redirect();
        } catch (\Exception $e) {
            Log::error("Socialite redirect failed for {$provider}: " . $e->getMessage(), [
                'exception' => $e,
            ]);
            return redirect('/auth')->with('error', 'Failed to redirect to ' . ucfirst($provider));
        }
    }

    public function handleProviderCallback(string $provider)
    {
        if (! in_array($provider, SocialProviders::all())) {
            Log::error("Invalid provider callback: {$provider}");
            return redirect('/auth')->with('error', 'Invalid provider');
        }

        // ─── KICK callback: exchange code → token → userinfo here ───
        if ($provider === 'kick') 
        {
        $state = request('state');
        $savedState = session('kick_oauth_state');
        $codeVerifier = session('kick_code_verifier');

        Log::debug('Kick callback state in session:', ['saved_state' => $savedState]);

        if (!$state || !$savedState || $state !== $savedState) {
            Log::error("Kick OAuth state mismatch or missing");
            return redirect('/auth')->with('error', 'Invalid OAuth state. Please try again.');
        }

        $code = request('code');
        if (!$code) {
            Log::error("Kick callback missing 'code' parameter");
            return redirect('/auth')->with('error', 'Kick authorization code missing.');
        }

        // Token exchange with code_verifier included
        $response = \Http::asForm()->post('https://id.kick.com/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.kick.client_id'),
            'client_secret' => config('services.kick.client_secret'),
            'redirect_uri' => config('services.kick.redirect'),
            'code' => $code,
            'code_verifier' => $codeVerifier,
        ]);

        if (!$response->successful()) {
            Log::error("Kick token exchange failed", ['response' => $response->body()]);
            return redirect('/auth')->with('error', 'Kick authentication failed.');
        }

        $tokenData = $response->json();

        // Fetch user info from Kick's API
        $userResponse = \Http::withToken($tokenData['access_token'])
            ->get('https://api.kick.com/public/v1/users'); // Make sure this endpoint matches Kick's current API

        if (!$userResponse->successful()) {
            Log::error("Kick user fetch failed", ['response' => $userResponse->body()]);
            return redirect('/auth')->with('error', 'Failed to retrieve Kick user info.');
        }

        $userInfo = $userResponse->json();

        $kickdata = $userInfo['data'][0];

        $providerUser = (object)[
            'id' => $kickdata['user_id'],
            'email' => $kickdata['email'] ?? null,
            'name' => $kickdata['name'] ?? 'KickUser_' . \Str::random(4),
            'token' => $tokenData['access_token'],
            'refreshToken' => $tokenData['refresh_token'] ?? null,
        ];

        $user = $this->socialAccountService->createOrGetUser($providerUser, 'kick');
        $user->update(['last_login_at' => now()]);
        Auth::login($user);

        // Clean up session data
        session()->forget(['kick_oauth_state', 'kick_code_verifier']);

        return redirect('/home')->with('success', 'Logged in successfully via Kick!');
    }

        // ─── All other providers: use Socialite to grab the user ───
        try {
            $driverName   = $provider === 'twitter' ? 'twitter-oauth-2' : $provider;
            $providerUser = Socialite::driver($driverName)->user();

            $user = $this->socialAccountService->createOrGetUser($providerUser, $provider);
            $user->update(['last_login_at' => now()]);
            Auth::login($user);

            return redirect('/home')->with('success', 'Logged in successfully via ' . ucfirst($provider) . '!');
        } catch (\Exception $e) {
            Log::error("Socialite authentication failed for {$provider}: {$e->getMessage()}", [
                'exception' => $e,
            ]);
            return redirect('/auth')->with('error', 'Authentication failed. Please try again.');
        }
    }
    protected function generateCodeVerifier(): string
    {
        return bin2hex(random_bytes(64)); 
    }

    protected function generateCodeChallenge(string $codeVerifier): string
    {
        return rtrim(strtr(base64_encode(hash('sha256', $codeVerifier, true)), '+/', '-_'), '=');
    }
    
    protected function generateState(): string
    {
        return bin2hex(random_bytes(16)); 
    }

}
