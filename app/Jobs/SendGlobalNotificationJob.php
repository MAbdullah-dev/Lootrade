<?php

namespace App\Jobs;

use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendGlobalNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // 👇 Make this property PUBLIC to survive queue serialization
    public string $message;

    /**
     * Create a new job instance.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
        Log::info("Constructed SendGlobalNotificationJob with message: " . (is_null($message) ? 'NULL' : $message));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NotificationService $notificationService)
    {
        Log::info("Handling SendGlobalNotificationJob with message: " . (is_null($this->message) ? 'NULL' : $this->message));

        $notificationService->sendGlobalNotificationToAllUsers($this->message);

        Log::info("Finished SendGlobalNotificationJob");
    }
}
