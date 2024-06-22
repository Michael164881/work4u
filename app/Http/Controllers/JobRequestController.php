<?php

namespace App\Http\Controllers;

use App\Models\job_request;
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
        $request->validate([
            'job_name' => 'required|string|max:255',
            'job_description' => 'required|string',
            'job_period' => 'required|integer',
            'initial_price' => 'required|numeric',
        ]);

        DB::table('job_request')->insert([
            'job_name' => $request->job_name,
            'job_description' => $request->job_description,
            'job_period' => $request->job_period,
            'initial_price' => $request->initial_price,
            'user_id' => Auth::id(),
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
        $request->validate([
            'job_name' => 'required|string|max:255',
            'job_description' => 'required|string',
            'job_period' => 'required|integer',
            'initial_price' => 'required|numeric',
        ]);

        DB::table('job_request')->where('id', $request->id)->update([
            'job_name' => $request->job_name,
            'job_description' => $request->job_description,
            'job_period' => $request->job_period,
            'initial_price' => $request->initial_price,
            'user_id' => Auth::id(),
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
        $jobRequest->delete();

        return redirect()->route('pageCustMap.index', 'map')->with('success', 'Job request deleted successfully.');
    }
}
