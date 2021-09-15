<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'short_description'
        
    ];

    public function category()
    {
        return $this->belongsTo(ImageCategory::class, 'imagecategory_id', 'id');
    }
}
