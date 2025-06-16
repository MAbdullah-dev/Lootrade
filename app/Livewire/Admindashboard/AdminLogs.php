<?php

namespace App\Livewire\Admindashboard;

use App\Exports\AdminLogsExport;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminLogs extends Component
{
    use WithPagination;

    public $search = '';
    public $fromDate;
    public $toDate;

    protected $queryString = ['search', 'fromDate', 'toDate'];

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatedFromDate() {
        $this->resetPage();
    }

    public function updatedToDate() {
        $this->resetPage();
    }

    public function exportLogs(): BinaryFileResponse
{
    return Excel::download(new AdminLogsExport, 'admin-logs.xlsx');
}

    public function getLogsQuery()
    {
        return Activity::query()
            ->where('causer_type', User::class)
            ->whereHasMorph('causer', [User::class], function ($q) {
                $q->where('role_id', 2); // only admins
            })
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('description', 'like', "%{$this->search}%")
                          ->orWhereJsonContains('properties->target_user_name', $this->search);
                });
            })
            ->when($this->fromDate, fn($q) => $q->whereDate('created_at', '>=', Carbon::parse($this->fromDate)))
            ->when($this->toDate, fn($q) => $q->whereDate('created_at', '<=', Carbon::parse($this->toDate)))
            ->latest();
    }

    public function render()
    {
        $logs = $this->getLogsQuery()->paginate(10);

        return view('livewire.admindashboard.admin-logs', compact('logs'))
            ->layout('components.layouts.Admindashboard');
    }
}
