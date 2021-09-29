<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralDiscountPercentage extends Model
{
    use HasFactory;

    public function next(){
        // get next user
        return ReferralDiscountPercentage::where('id', '>', $this->id)->orderBy('id','asc')->first();

    }
    public  function previous(){
        // get previous  user
        return ReferralDiscountPercentage::where('id', '<', $this->id)->orderBy('id','desc')->first();

    }
}
