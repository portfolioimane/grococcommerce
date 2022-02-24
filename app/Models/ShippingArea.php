<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingArea extends Model
{
    use HasFactory;
    protected $fillable = ['city','status'];

    // relation with order 

    public function order(){
        
        return $this->hasMany('App\Model\Order\Order');
 
    }

    public function user(){
        return $this->hasMany('App\User');
    }

    // public function admin()
    // {
    //     return $this->hasMany('App\Model\Admin');
    // }
}
