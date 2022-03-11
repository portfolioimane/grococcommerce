<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $table = "campaigns";

    // relation with product 

    public function product()
    {
       return $this->hasMany('App\Model\Product');
    }
}
