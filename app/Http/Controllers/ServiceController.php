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

    public function showHirePage($id)
    {
        $service = work_description::findOrFail($id);
        $user = auth()->user(); // Assuming the user is logged in
        $address = work_description::select('work_address')->findOrFail($id);
        return view('customer.pages.hire', compact('service', 'user', 'address'));
    }

    public function processHire(Request $request, $id)
    {
        // Process the payment based on the chosen method
        $service = work_description::findOrFail($id);

        // Add your payment processing logic here

        return redirect()->route('hire.show', ['service' => $service->id])->with('success', 'Payment successful');
    }
}


