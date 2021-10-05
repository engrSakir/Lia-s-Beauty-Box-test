<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(UserCategory::class, 'category_id', 'id');
    }

    public function referBy()
    {
        return $this->belongsTo(User::class, 'refer_by_id', 'id');
    }

    public function referUsers()
    {
        return $this->hasMany(User::class, 'refer_by_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'customer_id', 'id');
    }

    public function salaries()
    {
        return $this->hasMany(EmployeeSalary::class, 'employee_id', 'id');
    }

    public function invoices()
    {
        return $this->hasManyThrough(
            Invoice::class,
            Appointment::class,
            'customer_id',
            'appointment_id',
            'id',
            'id'
        );
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... code here
            do {
                $referral_code = mt_rand( 000001, 999999 );
            } while (User::where( 'referral_code', $referral_code )->exists());
            $model->referral_code = $referral_code;
        });

        self::created(function($model){
            // ... code here
        });

        self::updating(function($model){
            // ... code here
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }


}
