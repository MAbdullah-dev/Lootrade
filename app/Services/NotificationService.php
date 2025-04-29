<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function sendGlobalNotificationToAllUsers(string $message, string $type = 'GlobalNotification')
    {
        Log::info("Entering sendGlobalNotificationToAllUsers with message: " . $message);

        if (empty($message)) {
            Log::error("Message is empty");
            throw new \InvalidArgumentException("Notification message cannot be empty");
        }

        $userCount = User::count();
        Log::info("Total users: {$userCount}");

        if ($userCount === 0) {
            Log::info("No users found, skipping notification insertion.");
            return true;
        }

        $insertedCount = 0;

        // NO outer transaction!
        User::chunk(100, function ($users) use ($message, $type, &$insertedCount) {
            $notifications = [];

            foreach ($users as $user) {
                $notifications[] = [
                    'user_id'    => $user->id,
                    'type'       => $type,
                    'message'    => trim($message),  // <<< important to trim
                    'is_read'    => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($notifications)) {
                // Each chunk inserts separately
                DB::table('notifications')->insert($notifications);
                $insertedCount += count($notifications);
                Log::info("Inserted batch of " . count($notifications) . " notifications.");
            }
        });

        Log::info("Finished sending notifications. Total inserted: {$insertedCount}");

        return true;
    }
}
