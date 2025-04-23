<?php

namespace App\Console\Commands;

use App\Jobs\SelectRaffleWinnerJob;
use App\Models\Raffle;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessEndedRaffles extends Command
{
    protected $signature = 'raffles:process-ended';
    protected $description = 'Select winners for raffles that have ended';

    public function handle()
    {
        Log::info('Processing ended raffles...');
        // Get raffles that have ended
        $raffles = Raffle::where('status', 'active')
                         ->where('end_date', '<', now())
                         ->get();
                         if ($raffles->isEmpty()) {
                            Log::info('No raffles found or raffles have not ended yet');
                        }

        foreach ($raffles as $raffle) {
            // Dispatch the job for each raffle
            SelectRaffleWinnerJob::dispatch($raffle->id);

            // Optionally log this information for debugging
            Log::info('Dispatching job for raffle', ['raffle_id' => $raffle->id]);
        }

        $this->info('Raffles processed.');
    }
}
