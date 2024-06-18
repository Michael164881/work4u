<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_request extends Model
{
    use HasFactory;

    public $table = 'job_request';

    protected $fillable = [
        'job_request_id',
        'customer_id',
        'job_description',
        'job_period',
        'make_bidding',
    ];
}
