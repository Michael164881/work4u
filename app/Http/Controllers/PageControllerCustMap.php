<?php

namespace App\Http\Controllers;
use App\Models\work_description;
use Illuminate\Http\Request;
use App\Models\job_request;
use App\Models\bid;
use Illuminate\Support\Facades\Auth;

class PageControllerCustMap extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = work_description::where('work_status', 'available')->take(4)->get();
        $user = Auth::user();

        $jobRequests = collect();
        $bids = collect();

        if ($user) {
            // Retrieve job requests for the authenticated user
            $jobRequests = job_request::where('user_id', $user->id)->get();

            // Retrieve bids for each job request
            foreach ($jobRequests as $jobRequest) {
                $jobRequestBids = bid::where('job_request_id', $jobRequest->id)->get();
                $bids = $bids->merge($jobRequestBids);
            }
        }

        return view('customer.pages.map', compact('services', 'jobRequests', 'bids'));
    }
}
