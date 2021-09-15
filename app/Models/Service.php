<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id', 'id');
    }
}




