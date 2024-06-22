<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freelancer_profile extends Model
{
    use HasFactory;

    public $table = 'freelancer_profile';

    protected $fillable = [
        'user_id',
        'location',
        'work_experience',
        'edu_quality',
        'nickname'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workDescriptions()
    {
        return $this->hasMany(work_description::class, 'freelancer_id');
    }
}
