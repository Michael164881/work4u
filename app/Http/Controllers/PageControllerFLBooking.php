<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\work_description;
use App\Models\user;
use App\Models\TaskChecklist;
use App\Models\freelancer_profile;
use Illuminate\Http\Request;

class PageControllerFLBooking extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $bookings = collect(); // Initialize as an empty collection

        if ($user && $user->freelancerProfile) {
            // Retrieve freelancer profile ID
            $freelancerProfileId = $user->freelancerProfile->id;

            // Initialize query for bookings based on freelancer profile ID
            $query = Booking::where('freelancer_profile_id', $freelancerProfileId)
                            ->with(['jobRequest.freelancerProfile', 'workDescription']);

            // Apply search filter
            if ($request->has('search') && $request->search != '') {
                $query->where(function($q) use ($request) {
                    $q->whereHas('workDescription', function($q) use ($request) {
                        $q->where('work_description_name', 'like', '%' . $request->search . '%');
                    })->orWhereHas('jobRequest', function($q) use ($request) {
                        $q->where('job_name', 'like', '%' . $request->search . '%');
                    });
                });
            }

            // Apply location filter
            if ($request->has('location') && $request->location != '') {
                $query->whereHas('jobRequest.freelancerProfile', function($q) use ($request) {
                    $q->where('location', $request->location);
                });
            }

            // Get filtered bookings
            $bookings = $query->get();
        }

        // Get distinct locations for filtering
        $locations = freelancer_profile::distinct('location')->pluck('location');

        return view('freelancer.pages.booking', compact('bookings', 'locations'));
    }

    public function show($id)
    {
        $booking = booking::findOrFail($id);
        $userID = $booking->user_id;
        $phone = null;

        $user = User::findOrFail($userID);

        // Assuming you have a view file for showing a single booking, adjust this according to your structure
        return view('freelancer.pages.bookingView', compact('booking', 'user'));
    }

    public function addChecklistItem(Request $request, $bookingId)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $checklistItem = new TaskChecklist();
        $checklistItem->booking_id = $bookingId;
        $checklistItem->checklist_description = $request->description;
        $checklistItem->status = 'pending';
        $checklistItem->created_at = now();
        $checklistItem->updated_at = now();
        $checklistItem->save();

        return redirect()->back()->with('success', 'Checklist item added successfully.');
    }

    public function updateChecklistItem(Request $request, $itemId)
    {
        $request->validate([
            'status' => 'required|string|in:pending,completed,failed',
        ]);

        $checklistItem = TaskChecklist::findOrFail($itemId);
        $checklistItem->status = $request->status;
        $checklistItem->save();

        return redirect()->back()->with('success', 'Checklist item updated successfully.');
    }

    public function deleteChecklistItem($itemId)
    {
        $checklistItem = TaskChecklist::findOrFail($itemId);
        $checklistItem->delete();

        return redirect()->back()->with('success', 'Checklist item deleted successfully.');
    }

    public function endTask($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Retrieve the user associated with the booking
        $user = auth()->user();

        // Update the booking status to 'completed'
        $booking->booking_status = 'completed';
        $booking->save();

        // Add the booking fee to the user's e-wallet balance
        $user->ewallet_balance += $booking->booking_fee;
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Task completed successfully and e-wallet balance updated.');
    }
}
