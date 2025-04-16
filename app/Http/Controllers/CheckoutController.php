<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        Log::info('Session ID: ' . $sessionId);

        try {
            $session = Session::retrieve($sessionId);
            Log::info('Session Details: ' . json_encode($session));

            $transactionId = $session->metadata->transaction_id ?? null;

            if (!$transactionId) {
                Log::error('Transaction ID not found in session metadata.');
                return redirect()->route('checkout.cancel')->with('error', 'Transaction not found.');
            }

            $transaction = Transaction::find($transactionId);

            if ($transaction && $session->payment_status === 'paid') {
                $transaction->update([
                    'payment_status' => 'paid'
                ]);
                Log::info('Transaction updated to paid: ' . $transaction->id);

                return view('paymentsuccess', ['transaction' => $transaction]);
            }

            Log::error('Transaction not completed successfully. Payment status: ' . $session->payment_status);
            return redirect()->route('checkout.cancel')->with('error', 'Payment not completed successfully.');
        } catch (\Exception $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
            return redirect()->route('checkout.cancel')->with('error', 'Something went wrong with your payment.');
        }
    }

    public function cancel()
    {
        return view('paymentFailed');
    }
}
