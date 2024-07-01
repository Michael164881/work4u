<?php

namespace App\Exports;

use App\Models\freelancer_profile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FreelancerProfileExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return freelancer_profile::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Created At',
            'Updated At',
            'user_id',
            'Location',
            'Work Experience',
            'Education Quality',
            'Nickname',
            'Average Rating',
            'Rating Count',
        ];
    }
}
