<?php

namespace App\Livewire\Admindashboard;

use App\Models\Transaction;
use App\Models\User; // 👈 import User model
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalUsers;
    public $monthlyRevenue;
    public $monthLabels;


    public function mount()
    {
        $this->totalUsers = User::count();

        $rawRevenue = Transaction::select(
            DB::raw("MONTH(created_at) as month"),
            DB::raw("SUM(total_price) as total")
        )
            ->where('payment_status', 'paid')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->pluck('total', 'month')
            ->toArray();

        $this->monthlyRevenue = $rawRevenue;

        // Generate readable month names for x-axis
        $this->monthLabels = [];
        foreach (array_keys($rawRevenue) as $monthNum) {
            $this->monthLabels[] = date('F', mktime(0, 0, 0, $monthNum, 1));
        }
    }


    public function render()
    {
        return view('livewire.admindashboard.dashboard')
            ->layout('components.layouts.Admindashboard');
    }
}
