<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\work_description;

class ServiceController extends Controller
{
    public function index($id)
    {
        $service = work_description::with('freelancerProfile.user')->findOrFail($id);
        $address = work_description::select('work_address')->findOrFail($id);
        return view('customer.pages.showService', compact('service', 'address'));
    }
}


