<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\job_request;

class ServiceFLController extends Controller
{
    public function index($id)
    {
        $service = job_request::with('user')->findOrFail($id);
        $address = job_request::select('job_address')->findOrFail($id);
        return view('freelancer.pages.showService', compact('service', 'address'));
    }

    public function showHirePage($id)
    {
        $service = job_request::findOrFail($id);
        $user = auth()->user(); // Assuming the user is logged in
        $address = job_request::select('job_address')->findOrFail($id);
        return view('freelancer.pages.hire.hire', compact('service', 'user', 'address'));
    }
}


