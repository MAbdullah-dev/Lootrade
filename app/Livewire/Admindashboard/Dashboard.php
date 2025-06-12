<?php

namespace App\Livewire\Admindashboard;

use App\Models\User;
use App\Models\Raffle;
use App\Models\RaffleTicket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $dates = [];
    public $newUsersChartData = [];
    public $activeUsersChartData = [];
    public $raffleStatusData = [];
    public $loginFrequencyChartData = [];
    public $ticketsEarnedChartData = [];
    public $ticketsUsedChartData = [];
    public $topUsernames = [];
    public $topUserPlayCounts = [];
    public $raffleParticipationChartData = [];

    public function mount()
    {
        $this->dates = collect(range(6, 0))->map(fn($i) => Carbon::now()->subDays($i)->format('Y-m-d'))->toArray();

        $this->newUsersChartData = collect($this->dates)
            ->map(fn($date) => User::whereDate('created_at', $date)->count())
            ->toArray();

        $this->activeUsersChartData = collect($this->dates)
            ->map(fn($date) => User::whereDate('last_login_at', $date)->count())
            ->toArray();

        $this->raffleStatusData = [
            'active' => Raffle::whereRaw("start_date <= NOW() AND end_date >= NOW()")->count(),
            'upcoming' => Raffle::whereRaw("start_date > NOW()")->count(),
            'past' => Raffle::whereRaw("end_date < NOW()")->count(),
        ];

        $totalUsers = User::count();
        $this->loginFrequencyChartData = collect($this->dates)->map(function ($date) use ($totalUsers) {
            $logins = User::whereDate('last_login_at', $date)->count();
            return $totalUsers ? round(($logins / $totalUsers) * 100, 2) : 0;
        })->toArray();

        $this->ticketsEarnedChartData = collect($this->dates)
            ->map(fn($date) => DB::table('user_tickets')->whereDate('created_at', $date)->count())
            ->toArray();

        $this->ticketsUsedChartData = collect($this->dates)
            ->map(fn($date) => DB::table('raffle_tickets')->whereDate('created_at', $date)->count())
            ->toArray();

        $topUsersRaw = DB::table('raffle_tickets')
            ->select('user_id', DB::raw('count(*) as plays'))
            ->groupBy('user_id')
            ->orderByDesc('plays')
            ->limit(5)
            ->get();

        $this->topUsernames = $topUsersRaw->map(function ($record) {
            $user = User::find($record->user_id);
            return $user ? $user->name : 'Unknown';
        })->toArray();

        $this->topUserPlayCounts = $topUsersRaw->pluck('plays')->toArray();

        $this->raffleParticipationChartData = collect($this->dates)
            ->map(fn($date) => RaffleTicket::whereDate('created_at', $date)->count())
            ->toArray();
    }

    public function render()
    {
        return view('livewire.admindashboard.dashboard')
            ->layout('components.layouts.Admindashboard');
    }
}
