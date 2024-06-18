<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    public $table = 'customer';

    protected $fillable = [
        'cust_id',
        'cust_name',
        'cust_gender',
        'cust_age',
        'cust_email',
        'cust_phone_no',
        'cust_password',
        'cust_location',
    ];
}
