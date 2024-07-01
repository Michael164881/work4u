<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FreelancerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'freelancer')->get(['name', 'email', 'ic', 'phone_number', 'location']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'IC',
            'Phone Number',
            'Location',
        ];
    }
}

