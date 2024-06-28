<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_profile_id',
        'job_request_id',
        'bid_amount',
    ];

    public function freelancerProfile()
    {
        return $this->belongsTo(freelancer_profile::class);
    }

    public function jobRequest()
    {
        return $this->belongsTo(job_request::class, 'job_request_id');
    }

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }
}