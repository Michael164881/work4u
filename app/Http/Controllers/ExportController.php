<?php

namespace App\Http\Controllers;

use App\Exports\WorkDescriptionExport;
use App\Exports\JobRequestExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportWorkDescriptions()
    {
        return Excel::download(new WorkDescriptionExport, 'work_descriptions.xlsx');
    }

    public function exportJobRequests()
    {
        return Excel::download(new JobRequestExport, 'job_requests.xlsx');
    }
}
