<?php

namespace App\Http\Controllers;

use App\Models\work_description;
use Illuminate\Http\Request;
use App\Models\freelancer_profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkDescriptionController extends Controller
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
        return view('freelancer.pages.workDescriptionCreate');
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
            'work_description_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('job_image')) {
            $jobImage = $request->file('job_image');
            $jobImageName = time() . '.' . $jobImage->getClientOriginalExtension();
            $jobImage->move(public_path('images/work_description_pictures'), $jobImageName);

            // Save the new profile picture path in the user profile
            $jobImageStore = 'images/work_description_pictures/' . $jobImageName;
        }

        $freelancerProfile = freelancer_profile::where('user_id', Auth::id())->firstOrFail();

        DB::table('work_description')->insert([
            'work_description_name' => $request->job_name,
            'work_description' => $request->job_description,
            'work_period' => $request->job_period,
            'work_fee' => $request->initial_price,
            'work_address' => $request->jobAddress,
            'work_description_image' => $jobImageStore,
            'freelancer_id' => $freelancerProfile->id,
            'work_status' => 'available',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('pageFLMap.index', 'map')->with('success', 'Job request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $workDescription = work_description::findOrFail($id);
        return view('freelancer.pages.workDescription.show', compact('workDescription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $workDescription = work_description::findOrFail($id);
        return view('freelancer.pages.workDescription.edit', compact('workDescription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $workDescription = work_description::findOrFail($id);

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
            $jobImage->move(public_path('images/work_description_pictures'), $jobImageName);

            // Save the new profile picture path in the user profile
            $workDescription->work_description_image = 'images/work_description_pictures/' . $jobImageName;
            $workDescription->save();
        }

        $freelancerProfile = freelancer_profile::where('user_id', Auth::id())->firstOrFail();

        DB::table('work_description')->where('id', $request->id)->update([
            'work_description_name' => $request->job_name,
            'work_description' => $request->job_description,
            'work_period' => $request->job_period,
            'work_fee' => $request->initial_price,
            'freelancer_id' => $freelancerProfile->id,
            'work_address' => $request->jobAddress,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('pageFLMap.index', 'map')->with('success', 'Job request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $workDescription = work_description::findOrFail($id);
        $workDescription->delete();

        return redirect()->route('pageFLMap.index', 'map')->with('success', 'Job request deleted successfully.');
    }
}
