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
}


