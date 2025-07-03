<?php

namespace App\Exports;

use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminLogsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Activity::with('causer')
            ->latest()
            ->get()
            ->map(function ($log) {
                $causer = $log->causer;
                $props = $log->properties ?? collect();

                return [
                    'ID' => $log->id,
                    'Description' => $log->description,
                    'Event' => $log->event ?? 'N/A',
                    'Admin Name' => $causer?->name ?? 'N/A',
                    'Admin ID' => $causer?->id ?? 'N/A',
                    'IP Address' => $props['ip'] ?? 'N/A',
                    'Target User ID' => $props['target_user_id'] ?? 'N/A',
                    'Target User Name' => $props['target_user_name'] ?? 'N/A',
                    'Created At' => $log->created_at->format('F j, Y g:i A'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Description',
            'Event',
            'Admin Name',
            'Admin ID',
            'IP Address',
            'Target User ID',
            'Target User Name',
            'Created At',
        ];
    }
}
