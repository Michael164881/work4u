<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_request extends Model
{
    use HasFactory;

    public $table = 'job_request';

    protected $fillable = [
        'user_id',
        'job_name',
        'job_description',
        'job_period',
        'initial_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
