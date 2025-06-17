<?php

namespace App\Livewire\Inc;

use App\Exports\AdminLogsExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Admindashboardsidebar extends Component
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

        public function exportLogs(): BinaryFileResponse
{
    return Excel::download(new AdminLogsExport, 'admin-logs.xlsx');
}
    public function render()
    {
        return view('livewire.inc.admindashboardsidebar');
    }
}
