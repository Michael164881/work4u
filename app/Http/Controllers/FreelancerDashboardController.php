<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreelancerDashboardController extends Controller
{
    public function index()
    {
        // return view for freelancer dashboard
        return view('freelancer.pages.dashboard');
    }
}