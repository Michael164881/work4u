<?php

namespace App\Exports;

use App\Models\work_description;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WorkDescriptionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return work_description::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Created At',
            'Updated At',
            'Freelancer ID',
            'Work Name',
            'Work Description',
            'Work Fee',
            'Work Period',
            'Work Address',
            'Work Status',
            'Work Description Image',
            
        ];
    }
}
