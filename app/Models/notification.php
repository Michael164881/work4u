<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;

    public $table = 'notification';

    protected $fillable = [
        'user_id',
        'booking_id',
        'work_description_id',
        'job_request_id',
        'wallet_cust_id',
        'bids_id',
        'notification_info',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->belongsTo(bid::class, 'bids_id');
    }

    public function jobRequest()
    {
        return $this->belongsTo(job_request::class, 'job_request_id');
    }

    public function workDescription()
    {
        return $this->belongsTo(work_description::class, 'work_description_id');
    }

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }
}
