<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure this is imported

class WithdrawController extends Controller
{
    public function show()
    {
        $balance = Auth::user()->ewallet_balance;
        return view('freelancer.withdraw.withdraw', compact('balance'));
    }

    public function withdrawPage()
    {
        $balance = Auth::user()->ewallet_balance;
        return view('freelancer.pages.ewallet.withdraw', compact('balance'));
    }

    public function withdraw(Request $request)
    {
        // Validate the input amount
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        $amount = $request->input('amount');

        // Check if the user has sufficient balance
        if ($amount > $user->ewallet_balance) {
            return redirect()->route('ewallet.withdrawPage')->with('status', 'Insufficient balance!');
        }

        // Deduct the amount from the user's balance
        $user->ewallet_balance -= $amount;
        $user->save();

        // Redirect back with a success message
        return redirect()->route('ewallet.withdrawPage')->with('status', 'Withdrawal successful!');
    }



}