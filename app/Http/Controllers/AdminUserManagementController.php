<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\FreelancerExport;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminUserManagementController extends Controller
{
    // Display a listing of the users
    public function index(Request $request)
    {
        $search = $request->input('search');

        $freelancers = User::where('role', 'freelancer')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10, ['*'], 'freelancers');

        $customers = User::where('role', 'customer')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10, ['*'], 'customers');

        return view('pages.map', compact('freelancers', 'customers'));
    }


    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.mapEdit', compact('user'));
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

        return redirect()->route('users.index', 'users')->with('success', 'User updated successfully');
    }

    // Remove the specified user from the database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pages.map')->with('success', 'User deleted successfully');
    }

    // Display the specified user details
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.mapShow', compact('user'));
    }

    public function export()
    {
        return Excel::download(new FreelancerExport, 'freelancers.xlsx');
    }

    public function exportCustomers()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}

