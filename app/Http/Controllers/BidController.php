<?php

namespace App\Http\Controllers;

use App\Models\bid;
use App\Models\job_request;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'freelancer_profile_id' => $request->freelancer,
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

    public function processBid(Request $request, job_request $service)
    {
        $validatedData = $request->validate([
            'bid_amount' => 'required|numeric|min:1',
        ]);
    
        // Ensure the authenticated user is fetched correctly
        $user = auth()->user();
    
        // Check if the user has a freelancer profile
        if ($user) {
            $freelancerProfileId = $user->freelancerProfile->id;
    
            // Create and save the new bid
            $bid = new bid();
            $bid->freelancer_profile_id = $freelancerProfileId;
            $bid->job_request_id = $service->id;
            $bid->bid_amount =  $request->bid_amount;
            $bid->save();
    
            return redirect()->route('pageFLMap.index', 'map')->with('success', 'Your bid has been submitted successfully.');
        } else {
            return redirect()->back()->with('error', 'You do not have a freelancer profile.');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bid_amount' => 'required|numeric|min:1',
        ]);

        // Find the bid by its ID
        $bid = bid::findOrFail($id);

        DB::table('bids')->where('id', $request->id)->update([
            'bid_amount' => $request->bid_amount,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Bid updated successfully.');
    }
}
