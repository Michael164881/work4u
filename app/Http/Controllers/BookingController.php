<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\work_description;
use App\Models\job_request;
use App\Models\user;
use App\Models\freelancer_profile;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $bookings = collect(); // Initialize as an empty collection

        if ($user) {
            // Retrieve user ID
            $userId = $user->id;
            
            // Execute the query to retrieve bookings and include related models
            $query = Booking::where('user_id', $userId)
                ->with(['workDescription', 'jobRequest']);

                if ($request->has('search') && $request->search != '') {
                    $query->where(function($q) use ($request) {
                        $q->whereHas('workDescription', function($q) use ($request) {
                            $q->where('work_description_name', 'like', '%' . $request->search . '%');
                        })->orWhereHas('jobRequest', function($q) use ($request) {
                            $q->where('job_name', 'like', '%' . $request->search . '%');
                        });
                    });
                }
        
                if ($request->has('location') && $request->location != '') {
                    $query->where(function($q) use ($request) {
                        $q->whereHas('workDescription.freelancerProfile', function($q) use ($request) {
                            $q->where('location', $request->location);
                        })->orWhereHas('jobRequest', function($q) use ($request) {
                            $q->where('job_address', $request->location);
                        });
                    });
                }
            // Get filtered bookings
            $bookings = $query->get();
        }

        // Extract unique locations from the filtered bookings
        $locations = $bookings->pluck('workDescription.freelancerProfile.location')->merge($bookings->pluck('jobRequest.job_address'))->unique();

        return view('customer.pages.booking', compact('bookings', 'locations'));
    }

    public function cancel($id)
    {
        $booking = booking::findOrFail($id);
        $user = auth()->user();

        // Check if the booking belongs to the authenticated user
        if ($booking->user_id != $user->id) {
            return redirect()->back()->with('error', 'You do not have permission to cancel this booking.');
        }

        // Refund the eWallet balance if payment was made through eWallet
        $user->ewallet_balance += $booking->booking_fee;
        $user->save();

        // Update booking status to cancelled
        $booking->booking_status = 'cancelled';
        $booking->save();

         // Update service status to available
         $service = work_description::findOrFail($booking->work_profile_id);
         $service->work_status = 'available';
         $service->save();

        return redirect()->route('bookings.index', 'booking')->with('success', 'Booking cancelled and payment refunded.');
    }

    public function rate(Request $request, $id)
    {
        $booking = booking::findOrFail($id);
        $user = auth()->user();

        // Check if the booking belongs to the authenticated user
        if ($booking->user_id != $user->id) {
            return redirect()->back()->with('error', 'You do not have permission to rate this booking.');
        }

        // Get the freelancer profile
        $freelancerProfile = $booking->workDescription->freelancerProfile;

        // Calculate the new average rating
        $newRating = $request->input('rating');
        $totalRating = $freelancerProfile->average_rating * $freelancerProfile->rating_count;
        $totalRating += $newRating;
        $freelancerProfile->rating_count++;
        $freelancerProfile->average_rating = $totalRating / $freelancerProfile->rating_count;

        // Save the freelancer profile
        $freelancerProfile->save();

        return redirect()->route('bookings.index', 'booking')->with('success', 'Rating submitted successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::with([
            'workDescription.freelancerProfile.user', 
            'jobRequest', 
            'taskChecklists',
            'freelancerProfile.user'
        ])->findOrFail($id);
    
        // Assuming you have a view file for showing a single booking, adjust this according to your structure
        return view('customer.pages.bookingView', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(booking $booking)
    {
        //
    }
}
