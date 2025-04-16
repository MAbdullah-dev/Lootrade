<?php
namespace App\Services;

use App\Models\TicketCounter;
use App\Models\UserTicket;
use Illuminate\Support\Facades\DB;

class TicketGenerationService
{
    /**
     * Generate tickets for a user.
     *
     * @param int $userId The ID of the user for whom tickets are generated.
     * @param int $quantity The number of tickets to generate.
     * @param string $acquisitionType 'purchased' or 'earned'.
     * @return \Illuminate\Database\Eloquent\Collection The generated tickets.
     */
    public function generateTickets($userId, $quantity, $acquisitionType = 'purchased')
    {
        if (!in_array($acquisitionType, ['purchased', 'earned'])) {
            throw new \InvalidArgumentException("Acquisition type must be 'purchased' or 'earned'.");
        }

        return DB::transaction(function () use ($userId, $quantity, $acquisitionType) {
            // Lock the ticket counter to prevent concurrent updates
            $counter = TicketCounter::lockForUpdate()->first();

            // Get the starting ticket number
            $start = $counter->next_ticket;

            // Increment the counter
            $counter->next_ticket += $quantity;
            $counter->save();

            // Generate tickets
            $tickets = [];
            for ($i = 0; $i < $quantity; $i++) {
                $ticketNumber = str_pad($start + $i, 6, '0', STR_PAD_LEFT);
                $tickets[] = [
                    'user_id' => $userId,
                    'ticket_number' => $ticketNumber,
                    'status' => 'available',
                    'acquisition_type' => $acquisitionType,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert tickets into user_tickets
            UserTicket::insert($tickets);

            // Return the inserted tickets
            return UserTicket::where('user_id', $userId)
                ->whereIn('ticket_number', array_column($tickets, 'ticket_number'))
                ->get();
        });
    }
}
