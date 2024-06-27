<?php

namespace App\Http\Controllers;

use App\Models\admin; //Probably useless
use App\Models\booking;
use App\Models\User;
use App\Models\work_description;
use App\Models\job_request;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch data count from each table for dashboard widget
        $freelancerCount = User::where('role', 'freelancer')->count();
        $customerCount = User::where('role', 'customer')->count();
        $bookingCount = booking::where('booking_status', 'pending')->count();
        $workDescriptionCount = work_description::count();
        $jobRequestCount = job_request::count();

        //Fetch data from tables
        $admin = User::where('role', 'admin')->get();
        $customer = User::where('role', 'customer')->get();
        $freelancer = User::where('role', 'freelancer')->get();
        $work = work_description::get();
        $job = job_request::get();

        // Pass the data to the view
        return view('pages.dashboard', compact(
            'freelancerCount',
            'customerCount',
            'bookingCount',
            'workDescriptionCount',
            'jobRequestCount',
            'admin',
            'customer',
            'freelancer',
            'work',
            'job'
        ));
    }

    public function __construct()
    {
        $this->middleware('auth');
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
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(admin $admin)
    {
        //
    }
}
