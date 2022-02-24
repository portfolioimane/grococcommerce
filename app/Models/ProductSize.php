<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_size';

    // public function product()
    // {
    //  return $this->belongsTo('App\Model\Product');
    // }

}
