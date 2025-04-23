<?php

namespace App\Jobs;

use App\Services\TicketGenerationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateTicketsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $quantity;
    protected $acquisitionType;

    public function __construct($userId, $quantity, $acquisitionType = 'earned')
    {
        $this->userId = $userId;
        $this->quantity = $quantity;
        $this->acquisitionType = $acquisitionType;
    }

    public function handle()
    {
        $service = new TicketGenerationService();
        $service->generateTickets($this->userId, $this->quantity, $this->acquisitionType);
    }
}
