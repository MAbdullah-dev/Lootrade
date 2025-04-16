<?php

namespace App\Livewire\Pages;

use App\Models\TicketPackage;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Redirect;

class Tickets extends Component
{
    public $Ticketpackages;
    public $selectedPackage = null;
    public $packageQuantity = 1;

    public function mount()
    {
        $this->loadticketpackages();
    }

    public function loadticketpackages()
    {
        $this->Ticketpackages = TicketPackage::get();
    }

    public function selectPackage($id)
    {
        $this->selectedPackage = TicketPackage::find($id);
        $this->packageQuantity = 1;
    }

    public function increment()
    {
        if ($this->selectedPackage) {
            $this->packageQuantity++;
        }
    }

    public function decrement()
    {
        if ($this->selectedPackage && $this->packageQuantity > 1) {
            $this->packageQuantity--;
        }
    }

    public function checkout()
    {
        if (!$this->selectedPackage) return;

        $user = Auth::user();

        // 1. Create pending transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'ticket_package_id' => $this->selectedPackage->id,
            'package_quantity' => $this->packageQuantity,
            'total_tickets' => $this->packageQuantity * $this->selectedPackage->tickets,
            'total_price' => $this->packageQuantity * $this->selectedPackage->price,
            'stripe_transaction_id' => 'temp_' . uniqid(), // placeholder until actual session ID
            'payment_status' => 'pending',
        ]);

        // 2. Create Stripe Checkout Session
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $this->selectedPackage->type . ' Package',
                    ],
                    'unit_amount' => $this->selectedPackage->price * 100,
                ],
                'quantity' => $this->packageQuantity,
            ]],
            'metadata' => [
                'transaction_id' => $transaction->id
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        // 3. Update Stripe ID in transaction
        $transaction->update([
            'stripe_transaction_id' => $session->id
        ]);

        return Redirect::away($session->url);
    }

    public function render()
    {
        return view('livewire.pages.tickets');
    }
}
