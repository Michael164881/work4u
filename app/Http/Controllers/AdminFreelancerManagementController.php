<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminFreelancerManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Retrieve freelancers, optionally filtered by search term
        $freelancers = User::where('role', 'freelancer')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('pages.freelancerProfile', compact('freelancers', 'search'));
    }

    public function show($id)
    {
        $freelancer = Freelancer::findOrFail($id);
        return view('pages.freelancersProfileshow', compact('freelancer'));
    }

    public function edit($id)
    {
        $freelancers = User::where('role', 'freelancer')->findOrFail($id);
        return view('pages.freelancerProfileEdit', compact('freelancers'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Exclude the password field from the update array if it's not present
        $data = $request->except('password');
        
        // If the password field is present, hash it
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        $user->update($data);

        return redirect()->route('freelancers.index', 'users')->with('success', 'Freelancer updated successfully');
    }

    public function destroy($id)
    {
        $freelancer = User::where('role', 'freelancer')->findOrFail($id);
        $freelancer->delete();

        return redirect()->route('freelancers.index', 'freelancers')->with('success', 'Freelancer deleted successfully');
    }
}

