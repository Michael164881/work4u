<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    public $table = 'booking';

    protected $fillable = [
        'booking_id', 
        'cust_id',
        'job_request_id',
        'work_profile_id',
        'booking_status',
        'biding_satus',
        'notification_id',
        'booking_start_date',
        'booking_end_date',
        'booking_fee',
    ];
}
