<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskChecklist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id',
        'checklist_description',
        'status',
    ];

    /**
     * Get the booking that owns the task checklist.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
