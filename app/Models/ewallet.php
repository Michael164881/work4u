<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ewallet extends Model
{
    use HasFactory;

    public $table = 'ewallet';

    protected $fillable = [
        'wallet_cust_id',
        'wallet_flancer_id',
        'ewallet_balance',
        'notification_id',
    ];
}
