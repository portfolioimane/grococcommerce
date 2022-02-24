<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory;
    protected $table = 'user_coupon';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
