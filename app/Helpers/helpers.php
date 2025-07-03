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
        
        if ($user && $user->role_id === 2) {
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
