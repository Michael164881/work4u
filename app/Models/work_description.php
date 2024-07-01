<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work_description extends Model
{
    use HasFactory;

    public $table = 'work_description';

    protected $fillable = [
        'freelancer_id',
        'work_description_name',
        'work_description',
        'work_fee',
        'work_period',
        'work_address',
        'work_status',
        'work_description_image'
    ];

    public function freelancerProfile()
    {
        return $this->belongsTo(freelancer_profile::class, 'freelancer_id');
    }

    public function notifications()
    {
        return $this->belongsTo(notification::class, 'work_description_id');
    }
}
