<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\work_description;
use App\Models\booking;
use App\Models\user;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function index($id)
    {
        $service = work_description::with('freelancerProfile.user')->findOrFail($id);
        $address = work_description::select('work_address')->findOrFail($id);
        return view('customer.pages.showService', compact('service', 'address'));
    }

    public function showHirePage($id)
    {
        $service = work_description::findOrFail($id);
        $user = auth()->user(); // Assuming the user is logged in
        $address = work_description::select('work_address')->findOrFail($id);
        return view('customer.pages.hire', compact('service', 'user', 'address'));
    }
    

    public function processHire(Request $request, $id)
    {
        $service = work_description::findOrFail($id);
        $user = auth()->user();

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        if ($request->payment_method == 'ewallet' && $user->ewallet_balance < $service->work_fee) {
            return redirect()->back()->with('error', 'Insufficient balance in eWallet.');
        }

        // Deduct the eWallet balance
        if ($request->payment_method == 'ewallet') {
            $user->ewallet_balance -= $service->work_fee;
            $user->save();
        }

        // Calculate booking end date
        $bookingStartDate = Carbon::now();
        $bookingEndDate = $bookingStartDate->copy()->addDays($service->work_period);

        // Create a new booking
        booking::create([
            'user_id' => $user->id,
            'work_profile_id' => $service->id,
            'job_request_id' => 0,
            'booking_status' => 'pending',
            'booking_start_date' => $bookingStartDate,
            'booking_end_date' => $bookingEndDate,
            'booking_fee' => $service->work_fee,
        ]);

        // Update service status to unavailable
        $service->work_status = 'unavailable';
        $service->save();

        return redirect()->route('bookings.index', 'booking')->with('success', 'Payment successful. Booking created.');
    }
}


