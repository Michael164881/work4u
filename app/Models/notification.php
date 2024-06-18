<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;

    public $table = 'notification';

    protected $fillable = [
        'notification_id',
        'wallet_flancer_id',
        'cust_id',
        'flancer_id',
        'wallet_cust_id',
        'booking_id',
        'work_profile_id',
        'notification_info',
    ];
}
