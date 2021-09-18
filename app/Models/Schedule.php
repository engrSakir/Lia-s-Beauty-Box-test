<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'starting_time',
        'ending_time',
        'schedule_day',
        'maximum_participant',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'schedule_id', 'id');
    }
}
