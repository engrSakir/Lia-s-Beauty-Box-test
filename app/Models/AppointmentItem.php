<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'appointment_id',
        'staff_id',
        'service_id',
        'quantity',
    ];
}
