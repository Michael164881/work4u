<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    public function showPaymentMethod()
    {
        $user = auth()->user();
        return view('customer.pages.payment.payment-method', compact('user'));
    }

    public function reloadEwallet(Request $request)
    {
        $user = auth()->user();
        $service = $user;
        $amount = $request->input('amount');
        $service->ewallet_balance += $amount;
        $service->save();

        return redirect()->route('pageCust.index', 'edit')->with('success', 'Amount added successfully.');
    }
}
