<?php

namespace App\Http\Controllers;

use App\Models\bid;
use App\Models\job_request;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\booking;

class BidController extends Controller
{
    public function index($id)
    {
        $bid = bid::findOrFail($id);

        $jobRequestID = $bid->job_request_id;
        $jobRequest = job_request::findOrFail($jobRequestID);
        return view('customer.pages.hire.hireBid', compact('bid', 'jobRequest'));
    }

    public function showHireBid($id)
    {
        $bid = bid::findOrFail($id); 
        $jobRequestID = $bid->job_request_id;
        $jobRequest = job_request::findOrFail($jobRequestID);
        $user = auth()->user(); // Assuming the user is logged in
        $address = job_request::select('job_address')->findOrFail($id);
        return view('customer.pages.hire.showHireBid', compact('bid', 'user', 'address', 'jobRequest'));
    }

    public function processHireBid(Request $request, $id)
    {
        $bid = bid::findOrFail($id);
        $jobRequestID = $bid->job_request_id;
        $jobRequest = job_request::findOrFail($jobRequestID);
        $user = auth()->user();

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        if ($request->payment_method == 'ewallet' && $user->ewallet_balance < $bid->bid_amount) {
            return redirect()->back()->with('error', 'Insufficient balance in eWallet.');
        }

        // Deduct the eWallet balance
        if ($request->payment_method == 'ewallet') {
            $user->ewallet_balance -= $bid->bid_amount;
            $user->save();
        }

        // Calculate booking end date
        $bookingStartDate = Carbon::now();
        $bookingEndDate = $bookingStartDate->copy()->addDays($jobRequest->job_period);

        // Create a new booking
        booking::create([
            'user_id' => $user->id,
            'work_profile_id' => 0,
            'job_request_id' => $jobRequest->id,
            'booking_status' => 'pending',
            'booking_start_date' => $bookingStartDate,
            'booking_end_date' => $bookingEndDate,
            'booking_fee' => $bid->bid_amount,
        ]);

        // Update service status to unavailable
        $jobRequest->job_status = 'unavailable';
        $jobRequest->save();

        return redirect()->route('bookings.index', 'booking')->with('success', 'Payment successful. Booking created.');
    }
}
