<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'imagecategory_id', 'id');
    }
}
