<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\freelancer_profile;

class AdminFreelancerManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = freelancer_profile::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nickname', 'like', '%' . $request->search . '%');
        }

        $freelancers = $query->get();

        return view('pages.freelancerProfile', compact('freelancers', 'search'));
    }

    public function show($id)
    {
        $freelancer = freelancer_profile::findOrFail($id);
        return view('pages.freelancerProfileShow', compact('freelancer'));
    }

    public function edit($id)
    {
        $freelancer = freelancer_profile::findOrFail($id);
        return view('pages.freelancerProfileEdit', compact('freelancer'));
    }

    public function update(Request $request, $id)
    {
        $freelancer = freelancer_profile::findOrFail($id);
        
        $data = $request->all();
        $freelancer->update($data);

        return redirect()->route('freelancers.index', 'users')->with('success', 'Freelancer updated successfully');
    }

    public function destroy($id)
    {
        $freelancer = freelancer_profile::findOrFail($id);
        $freelancer->delete();

        return redirect()->route('freelancers.index', 'freelancers')->with('success', 'Freelancer deleted successfully');
    }

    public function exportFreelancers()
    {
        return Excel::download(new FreelancerProfileExport, 'freelancers.xlsx');
    }
}

