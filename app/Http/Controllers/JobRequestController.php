<?php

namespace App\Http\Controllers;

use App\Models\job_request;
use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.pages.jobRequestCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jobImageStore = null;

        $request->validate([
            'job_name' => 'required|string|max:255',
            'job_description' => 'required|string',
            'job_period' => 'required|integer',
            'initial_price' => 'required|numeric',
            'jobAddress' => 'required|string',
            'job_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('job_image')) {
            $jobImage = $request->file('job_image');
            $jobImageName = time() . '.' . $jobImage->getClientOriginalExtension();
            $jobImage->move(public_path('images/job_image'), $jobImageName);

            // Save the new profile picture path in the user profile
            $jobImageStore = 'images/job_image/' . $jobImageName;
        }

        $jobRequest = job_request::create([
            'job_name' => $request->job_name,
            'job_description' => $request->job_description,
            'job_period' => $request->job_period,
            'initial_price' => $request->initial_price,
            'job_address' => $request->jobAddress,
            'job_image' => $jobImageStore,
            'user_id' => Auth::id(),
            'job_status' => 'available',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $jobRequestId = $jobRequest->id;
        $user = auth()->user();

        DB::table('notification')->insert([
            'user_id' => $user->id,
            'notification_info' => 'job request created',
            'booking_id' => null,
            'work_description_id' => null,
            'job_request_id' => $jobRequestId,
            'bids_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('pageCustMap.index', 'map')->with('success', 'Job request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jobRequest = job_request::findOrFail($id);
        return view('customer.pages.jobRequest.show', compact('jobRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jobRequest = job_request::findOrFail($id);
        return view('customer.pages.jobRequest.edit', compact('jobRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jobRequest = job_request::findOrFail($id);

        $request->validate([
            'job_name' => 'required|string|max:255',
            'job_description' => 'required|string',
            'job_period' => 'required|integer',
            'initial_price' => 'required|numeric',
            'jobAddress' => 'required|string',
            'job_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('job_image')) {
            $jobImage = $request->file('job_image');
            $jobImageName = time() . '.' . $jobImage->getClientOriginalExtension();
            $jobImage->move(public_path('images/job_image'), $jobImageName);

            // Save the new profile picture path in the user profile
            $jobRequest->job_image = 'images/job_image/' . $jobImageName;
            $jobRequest->save();
        }

        DB::table('job_request')->where('id', $request->id)->update([
            'job_name' => $request->job_name,
            'job_description' => $request->job_description,
            'job_period' => $request->job_period,
            'initial_price' => $request->initial_price,
            'job_address' => $request->jobAddress,
            'user_id' => Auth::id(),
            'updated_at' => now()
        ]);

        $jobRequestId = $jobRequest->id;
        $user = auth()->user();

        DB::table('notification')->insert([
            'user_id' => $user->id,
            'notification_info' => 'job request updated',
            'booking_id' => null,
            'work_description_id' => null,
            'job_request_id' => $jobRequestId,
            'bids_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('pageCustMap.index', 'map')->with('success', 'Job request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jobRequest = job_request::findOrFail($id);
        notification::where('job_request_id', $jobRequest->id)->delete();

        $jobRequest->delete();

        return redirect()->route('pageCustMap.index', 'map')->with('success', 'Job request deleted successfully.');
    }
}
