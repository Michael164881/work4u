<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use App\Models\notification;
use Illuminate\Support\Facades\DB;

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

        DB::table('notification')->insert([
            'user_id' => $user->id,
            'notification_info' => 'topup',
            'booking_id' => null,
            'work_description_id' => null,
            'job_request_id' => null,
            'bids_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('pageCust.index', 'edit')->with('success', 'Amount added successfully.');
    }
}
