<?php

namespace App\Http\Controllers;
use App\Models\work_description;
use App\Models\job_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\notification;

class PageControllerFL extends Controller
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
        if (view()->exists("freelancer.pages.{$page}")) {
            $user = auth()->user();
            $freelancerProfile = $user->freelancerProfile;
            $workAddress = work_description::all();
            $jobRequest = job_request::all();

            $user = Auth::user();
            $notification = notification::where('user_id', $user->id)->get();

            return view("freelancer.pages.{$page}",compact('workAddress', 'jobRequest', 'freelancerProfile', 'user', 'notification'));
        }

        return abort(404);
    }
}
