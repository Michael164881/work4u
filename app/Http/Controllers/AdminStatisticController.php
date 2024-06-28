<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\work_description;
use App\Models\job_request;
use Carbon\Carbon;
use App\Exports\StatisticsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminStatisticController extends Controller
{
    public function index(){
        $freelancerCount = User::where('role', 'freelancer')->count();
        $customerCount = User::where('role', 'customer')->count();
        $bookingCount = Booking::where('booking_status', 'pending')->count();
        $workDescriptionCount = work_description::count();
        $jobRequestCount = job_request::count();

        // Data for charts
        $months = range(1, 12);
        $freelancersPerMonth = User::where('role', 'freelancer')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        $customersPerMonth = User::where('role', 'customer')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        $workDescriptionsPerMonth = work_description::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        $jobRequestsPerMonth = job_request::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill missing months with 0
        $freelancersPerMonth = array_replace(array_fill_keys($months, 0), $freelancersPerMonth);
        $customersPerMonth = array_replace(array_fill_keys($months, 0), $customersPerMonth);
        $workDescriptionsPerMonth = array_replace(array_fill_keys($months, 0), $workDescriptionsPerMonth);
        $jobRequestsPerMonth = array_replace(array_fill_keys($months, 0), $jobRequestsPerMonth);

        return view('pages.tables', compact(
            'freelancerCount',
            'customerCount',
            'bookingCount',
            'workDescriptionCount',
            'jobRequestCount',
            'freelancersPerMonth',
            'customersPerMonth',
            'workDescriptionsPerMonth',
            'jobRequestsPerMonth'
        ));
    }

    public function export()
    {
        return Excel::download(new StatisticsExport, 'statistics.xlsx');
    }

}