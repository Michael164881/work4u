<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work_profile extends Model
{
    use HasFactory;

    public $table = 'work_profile';

    protected $fillable = [
        'flancer_id',
        'work_fee',
        'location',
        'work_description',
    ];
}
