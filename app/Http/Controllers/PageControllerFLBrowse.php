<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\job_request;
use App\Models\freelancer_profile;
use App\Models\User;

class PageControllerFLBrowse extends Controller
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
    public function index(Request $request)
    {
        $query = job_request::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('job_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('location') && $request->location != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('location', $request->location)->where('role', 'customer');
            });
        }

        $services = $query->get();

        // Get unique locations from freelancer_profile for the filter dropdown
        $locations = User::where('role', 'customer')->distinct()->pluck('location');
        return view('freelancer.pages.browse',compact('services', 'locations'));
    }
}
