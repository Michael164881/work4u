<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\work_description;
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
            
            // Execute the query to retrieve bookings and include work_description
            $bookings = Booking::where('user_id', $userId)
                ->with('workDescription') // Eager load the work_description relationship
                ->get();
        }

        $query = booking::query();
        $locationsQuery = freelancer_profile::query()->distinct('location');

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('workDescription', function($q) use ($request) {
                $q->where('work_description_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('location') && $request->location != '') {
            // Assuming FreelancerProfile is related through WorkDescription
            $query->whereHas('workDescription.freelancerProfile', function($q) use ($request) {
                $q->where('location', $request->location);
            });
        }
    
        $bookings = $query->get();

        // Extract unique locations from the filtered bookings
        $locations = Booking::with('workDescription.freelancerProfile')->get()->pluck('workDescription.freelancerProfile.location')->unique();

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
        $user->balance += $booking->booking_fee;
        $user->save();

        // Update booking status to cancelled
        $booking->booking_status = 'cancelled';
        $booking->save();

        // Update service status to available
        $service = $booking->service;
        $service->status = 'available';
        $service->save();

        return redirect()->route('bookings.index')->with('success', 'Booking cancelled and payment refunded.');
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
        $booking = booking::findOrFail($id);

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
