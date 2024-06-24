<?php

namespace App\Http\Controllers;
use App\Models\work_description;
use Illuminate\Http\Request;
use App\Models\job_request;
use App\Models\freelancer_profile;
use Illuminate\Support\Facades\Auth;

class PageControllerFLMap extends Controller
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
        $services = job_request::all();
        $user = Auth::user();

        $workDescription = collect();
        $userId = null;
        $freelancerId = null;

        if ($user) {
            // Retrieve user ID
            $userId = $user->id;
            $freelancer = freelancer_profile::where('user_id', $userId)->first();

            if ($freelancer) {
                // Retrieve freelancer ID
                $freelancerId = $freelancer->id;

                // Retrieve work descriptions for the freelancer
                $workDescription = work_description::where('freelancer_id', $freelancerId)->get();
            }
        }
        return view('freelancer.pages.map',compact('services', 'workDescription'));
    }
}
