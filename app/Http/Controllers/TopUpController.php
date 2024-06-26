<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopUpController extends Controller
{
    public function showPaymentMethod()
    {
        return view('customer.pages.payment.payment-method');
    }

    public function processEwallet(Request $request)
    {
        // Validate the request data
        $request->validate([
            'ewalletId' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Process the linking logic here
        // For example, saving to the database or making an API call

        return redirect()->back()->with('success', 'eWallet linked successfully!');
    }

    public function processDebit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'card_number' => 'required|string|max:16',
            'expiry_date' => 'required|string|max:5',
            'cvv' => 'required|string|max:3',
        ]);

        // Process the debit card payment logic here
        // For example, saving to the database or making an API call

        return redirect()->back()->with('success', 'Debit card payment processed successfully!');
    }

    public function processQr(Request $request)
    {
        // Validate the request data
        // No specific validation needed for QR code payments in this example

        // Process the QR code payment logic here
        // For example, saving to the database or making an API call

        return redirect()->back()->with('success', 'QR code payment processed successfully!');
    }

    public function redirectToTouchNGo(Request $request)
    {
        // Optionally validate the request data if needed
        $request->validate([
            'ewalletId' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Redirect to the Touch 'n Go website
        return redirect()->away('https://www.touchngo.com.my');
    }

    public function process(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        switch ($paymentMethod) {
            case 'debit':
                return redirect()->route('payment.debit');
            case 'ewallet':
                return redirect()->route('payment.ewallet');
            case 'qr':
                return redirect()->route('payment.qr');
            default:
                return redirect()->back()->with('error', 'Please select a valid payment method.');
        }
    }

    public function debit()
    {
        return view('payment.debit'); // Ensure you have a view file named debit.blade.php
    }

    public function ewallet()
    {
        return view('payment.ewallet'); // Ensure you have a view file named ewallet.blade.php
    }

    public function qr()
    {
        return view('payment.qr'); // Ensure you have a view file named qr.blade.php
    }

    public function reloadEwallet(Request $request)
    {
        $amount = $request->input('amount');
        // Logic to update the eWallet balance
        $newBalance = $this->updateEwalletBalance($amount); // Assume this method updates the balance and returns the new balance

        return redirect()->route('payment.ewallet')->with('balance', $newBalance);
    }

    private function updateEwalletBalance($amount)
    {
        // Implement the logic to update the eWallet balance
        // For example, fetching the current balance, adding the amount, and saving the new balance
        $currentBalance = 100.00; // Example current balance
        $newBalance = $currentBalance + $amount;
        // Save the new balance to the database or session

        return $newBalance;
    }
}
