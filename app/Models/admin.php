<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;

    public $table = 'admin';

    protected $fillable = [
        'admin_password', 
        'add_job_description',
    ];
}
