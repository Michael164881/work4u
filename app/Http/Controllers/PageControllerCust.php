<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\work_description;
use App\Models\job_request;
use App\Models\notification;
use Illuminate\Support\Facades\Auth;

class PageControllerCust extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("customer.pages.{$page}")) {
            $workAddress = work_description::all();
            $jobRequest = job_request::all();

            $user = Auth::user();
            $notification = notification::where('user_id', $user->id)->get();

            return view("customer.pages.{$page}",compact('workAddress', 'jobRequest', 'notification'));
        }

        return abort(404);
    }
}
