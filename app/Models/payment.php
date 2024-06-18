<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    public $table = 'payment';

    protected $fillable = [
        'payment_id', 
        'booking_id', 
        'wallet_cust_id', 
        'wallet_flancer_id', 
        'payment_method', 
        'amount', 
        'notification_id',
    ];
}
