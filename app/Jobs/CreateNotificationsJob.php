<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $eventType;
    protected $message;

    public function __construct(string $eventType, string $message)
    {
        $this->eventType = $eventType;
        $this->message = $message;
    }

    public function handle()
    {
        User::chunk(100, function ($users) {
            $notifications = [];
            foreach ($users as $user) {
                $notifications[] = [
                    'user_id' => $user->id,
                    'type' => $this->eventType,
                    'message' => $this->message,
                    'is_read' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('notifications')->insert($notifications);
        });
    }
}