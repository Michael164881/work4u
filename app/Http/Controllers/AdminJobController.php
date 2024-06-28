<?php

namespace App\Http\Controllers;

use App\Models\work_description;
use App\Models\job_request;
use App\Exports\JobsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminJobController extends Controller
{
    public function index()
    {
        $workDescriptions = work_description::with('freelancerProfile')->get();
        $jobRequests = job_request::with('user', 'bids.freelancerProfile')->get();
        
        return view('pages.jobManagement', compact('workDescriptions', 'jobRequests'));
    } 

    public function showJobRequest($id)
    {
        $jobRequest = job_request::findOrFail($id);
        return view('pages.jobRequestView', compact('jobRequest'));
    }

    public function showWorkDescription($id)
    {
        $workDescription = work_description::findOrFail($id);
        return view('pages.workDescriptionView', compact('workDescription'));
    }

    public function editJobRequest($id)
    {
        $jobRequest = job_request::findOrFail($id);
        return view('pages.jobRequestEdit', compact('jobRequest'));
    }

    public function updateJobRequest(Request $request, $id)
    {
        $jobRequest = job_request::findOrFail($id);
        $jobRequest->update($request->all());
        return redirect()->route('job.index', 'job')->with('success', 'Job Request updated successfully.');
    }

    public function editWorkDescription($id)
    {
        $workDescription = work_description::findOrFail($id);
        return view('pages.workDescriptionEdit', compact('workDescription'));
    }

    public function updateWorkDescription(Request $request, $id)
    {
        $workDescription = work_description::findOrFail($id);
        $workDescription->update($request->all());
        return redirect()->route('job.index', 'job')->with('success', 'Work Description updated successfully.');
    }

    public function destroyWorkDescription($id)
    {
        $jobRequest = work_description::findOrFail($id);
        $jobRequest->delete();

        return redirect()->route('job.index', 'job')->with('success', 'Job request deleted successfully');
    }

    public function destroyJobRequest($id)
    {
        $jobRequest = job_request::findOrFail($id);
        $jobRequest->delete();

        return redirect()->route('job.index', 'job')->with('success', 'Job request deleted successfully');
    }

    public function exportJobs()
    {
        return Excel::download(new JobsExport, 'jobs.xlsx');
    }
}
