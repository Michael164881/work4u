<?php

namespace App\Http\Controllers;
use App\Models\work_description;
use Illuminate\Http\Request;

use App\Models\freelancer_profile;

class PageControllerCustBrowse extends Controller
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
        

        $query = work_description::query();

        $query->where('work_status', 'available');

        if ($request->has('search') && $request->search != '') {
            $query->where('work_description_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('location') && $request->location != '') {
            $query->whereHas('freelancerProfile', function($q) use ($request) {
                $q->where('location', $request->location);
            });
        }

        $services = $query->get();

        // Get unique locations from freelancer_profile for the filter dropdown
        $locations = freelancer_profile::distinct('location')->pluck('location');
        return view('customer.pages.browse',compact('services', 'locations'));
    }
}
