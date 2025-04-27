<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;
use App\Models\NewsletterSubscriber;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsletterSubscription extends Component
{
    public $subscribers;

    public function mount()
    {
        $this->subscribers = NewsletterSubscriber::latest()->get();
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = 'subscribers.csv';

        $subscribers = NewsletterSubscriber::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Email', 'Subscribed At'];

        $callback = function() use ($subscribers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->id,
                    $subscriber->email,
                    $subscriber->created_at->format('d M Y'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        return view('livewire.admindashboard.newsletter-subscription')->layout('components.layouts.Admindashboard');
    }
}
