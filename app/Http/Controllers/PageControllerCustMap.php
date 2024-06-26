<?php

namespace App\Http\Controllers;
use App\Models\work_description;
use Illuminate\Http\Request;
use App\Models\job_request;
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
        $userId = null;

        if ($user) {
            // Retrieve user ID
            $userId = $user->id;
            
            // Retrieve job requests for the authenticated user
            $jobRequests = job_request::where('user_id', $userId)->get();
        }
        return view('customer.pages.map',compact('services', 'jobRequests'));
    }
}
