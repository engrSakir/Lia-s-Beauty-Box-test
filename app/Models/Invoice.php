<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'vat_percentage',
        'discount_percentage',
        'note'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    // Auto delete depend data
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($invoice) {
            $invoice->items()->delete();
        });
    }

    public function price()
    {
        $total_price = 0;
        $total_vat = 0;
        $total_price_include_vat = 0;
        foreach ($this->items as $item) {
            $total_price += $item->price * $item->quantity;
            $total_vat += round(($this->vat_percentage / 100) * $item->price, 2) * $item->quantity;
            $total_price_include_vat += round(($item->price + (($this->vat_percentage / 100) * $item->price)) * $item->quantity, 2);
        }
        return $total_price + $total_vat - $this->fixed_discount - round(($this->discount_percentage / 100) * $total_price, 2);
    }

    public function vat()
    {
        $total_vat = 0;
        foreach ($this->items as $item) {
            $total_vat += round(($this->vat_percentage / 100) * $item->price, 2) * $item->quantity;
        }
        return $total_vat;
    }
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
}
