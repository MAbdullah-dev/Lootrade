<?php

namespace App\Livewire\Admindashboard;

use App\Models\Winner;
use App\Exports\WinnersExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminWinners extends Component
{
    public function render()
    {
        $winners = Winner::with(['raffle', 'user'])->latest('awarded_at')->get();

        return view('livewire.admindashboard.admin-winners', [
            'winners' => $winners,
        ])->layout('components.layouts.Admindashboard');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new WinnersExport, 'winners.xlsx');
    }
}
