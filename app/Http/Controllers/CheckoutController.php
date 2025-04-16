<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');

        try {
            $session = Session::retrieve($sessionId);
            $transactionId = $session->metadata->transaction_id ?? null;

            if (!$transactionId) {
                return redirect()->route('checkout.cancel')->with('error', 'Transaction not found.');
            }

            $transaction = Transaction::find($transactionId);

            if ($transaction && $session->payment_status === 'paid') {
                $transaction->update([
                    'payment_status' => 'paid'
                ]);
            }

            return view('thank-you', ['transaction' => $transaction]);
        } catch (\Exception $e) {
            return redirect()->route('checkout.cancel')->with('error', 'Something went wrong with your payment.');
        }
    }

    public function cancel()
    {
        return view('cancel');
    }
}
