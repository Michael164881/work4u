<?php

namespace App\Http\Controllers;

use App\Models\bid;
use App\Models\job_request;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function showHirePage($id)
    {
        $bid = bid::findOrFail($id);
        $jobRequestID = $bid->job_request_id;
        $jobRequest = job_request::where('id', $jobRequestID);
        return view('customer.pages.hire.hireBid', compact('bid', 'jobRequest'));
    }
}
