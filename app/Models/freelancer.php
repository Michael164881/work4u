<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freelancer extends Model
{
    use HasFactory;

    public $table = 'freelancer';

    protected $fillable = [
        'flancer_id',
        'flancer_name',
        'flancer_gender',
        'flancer_age',
        'flancer_email',
        'flancer_phone_no',
        'flancer_work_experience',
        'flancer_edu_quality',
        'flancer_nickname',
    ];
}
