<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductKeyword extends Model
{
    use HasFactory;
    protected $table = 'product_keywords';

    public function product()
    {

        return $this->belongsTo('App\Model\Product');
    }
}
