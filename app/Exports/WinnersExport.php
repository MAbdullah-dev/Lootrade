<?php
namespace App\Exports;

use App\Models\Winner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WinnersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Winner::with(['raffle', 'user'])
            ->get()
            ->map(function ($winner) {
                return [
                    'ID' => $winner->id,
                    'Raffle Title' => $winner->raffle?->title ?? 'N/A',
                    'Prize' => $winner->prize,
                    'Winner Name' => $winner->user?->username ?? 'N/A',
                    'Awarded At' => $winner->awarded_at->format('F j, Y g:i A'),
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Raffle Title', 'Prize', 'Winner Name', 'Awarded At'];
    }
}
