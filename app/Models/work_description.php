<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work_description extends Model
{
    use HasFactory;

    public $table = 'work_description';

    protected $fillable = [
        'work_description_id',
        'work_description',
        'work_period',
    ];
}
