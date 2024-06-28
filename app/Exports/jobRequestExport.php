<?php

namespace App\Exports;

use App\Models\job_request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobRequestExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return job_request::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Created At',
            'Updated At',
            'user_id',
            'Job Name',
            'Job Description',
            'Job Period',
            'Initial Price',
            'Job Address',
            'Job Status',
        ];
    }
}
