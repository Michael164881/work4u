<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Booking::with(['workDescription', 'workDescription.freelancerProfile.user'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Booking ID',
            'User ID',
            'Work Description Name',
            'Booking Fee',
            'Booking Status',
            'Booking Start Date',
            'Booking End Date',
            'Freelancer Name',
            'Freelancer Phone'
        ];
    }

    /**
     * @param mixed $booking
     *
     * @return array
     */
    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->user_id,
            optional($booking->workDescription)->work_description_name,
            $booking->booking_fee,
            $booking->booking_status,
            $booking->booking_start_date,
            $booking->booking_end_date,
            optional($booking->workDescription->freelancerProfile->user)->name,
            optional($booking->workDescription->freelancerProfile->user)->phone_number
        ];
    }
}


