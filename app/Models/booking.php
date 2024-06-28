<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    public $table = 'booking';

    protected $fillable = [
        'booking_id', 
        'user_id',
        'job_request_id',
        'work_profile_id',
        'booking_status',
        'notification_id',
        'booking_start_date',
        'booking_end_date',
        'booking_fee',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workDescription()
    {
        return $this->belongsTo(work_description::class, 'work_profile_id');
    }


    public function taskChecklists()
    {
        return $this->hasMany(TaskChecklist::class);
    }
    public function jobRequest()
    {
        return $this->belongsTo(job_request::class, 'job_request_id');
    }
}
