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
        'booked_by_admin',
    ];


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function appointment_items()
    {
        return $this->hasMany(AppointmentItem::class, 'appointment_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'appointment_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(AppointmentItem::class, 'appointment_id', 'id');
    }
}
