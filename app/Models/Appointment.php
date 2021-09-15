<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'schedule_id',
        'service_id',
        'appointment_data',
        'message',
        'status',
    ];
}
