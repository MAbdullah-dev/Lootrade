<?php

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

if (!function_exists('alert_success')) {
    /**
     * Show a success toast alert.
     *
     * @param string $message
     * @param int $delay (in milliseconds)
     * @return void
     */
    function alert_success(string $message, int $delay = 1000)
    {
        LivewireAlert::title($message)
            ->success()
            ->toast()
            ->position('top-end')
            ->timer($delay)
            ->show();
    }
}

if (!function_exists('alert_error')) {
    /**
     * Show an error toast alert.
     *
     * @param string $message
     * @param int $delay (in milliseconds)
     * @return void
     */
    function alert_error(string $message, int $delay = 3000)
    {
        LivewireAlert::title($message)
            ->error()
            ->toast()
            ->position('top-end')
            ->timer($delay)
            ->show();
    }
}

// admin log
if (!function_exists('adminLog')) {
    function adminLog(string $description, array $properties = []): void
    {
        $user = auth()->user();

        if ($user && $user->hasRole('admin')) {
            activity()
                ->causedBy($user)
                ->withProperties(array_merge([
                    'role' => 'admin',
                    'ip' => request()->ip(),
                ], $properties))
                ->log($description);
        }
    }
}


//task icons
function getPlatformIcon($platform): string
{
    return match(strtolower($platform)) {
        'youtube' => '<i class="fab fa-youtube text-danger"></i>',
        'discord' => '<i class="fab fa-discord text-primary"></i>',
        'twitch'  => '<i class="fas fa-tv text-success"></i>',
        'instagram' => '<i class="fab fa-instagram text-warning"></i>',
        'kick' => '<i class="fas fa-gamepad text-success"></i>',
        'x', 'twitter' => '<i class="fab fa-x-twitter text-info"></i>',
        'telegram' => '<i class="fab fa-telegram text-cyan-500"></i>',
        'facebook' => '<i class="fab fa-facebook text-blue-700"></i>',
        'tiktok' => '<i class="fab fa-tiktok text-black"></i>',
        'reddit' => '<i class="fab fa-reddit text-orange-500"></i>',
        'linkedin' => '<i class="fab fa-linkedin text-blue-600"></i>',
        'github' => '<i class="fab fa-github text-gray-400"></i>',
        'steam' => '<i class="fab fa-steam text-blue-400"></i>',
        default => '<i class="fas fa-link"></i>',
    };
}
