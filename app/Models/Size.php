<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo('App\Model\Category')->withDefault([
            'id' => 0,
            'category_name' => 'N/A',
            'category_native_name' => 'N/A'
        ]);
    }

    public function product()
    {
        return $this->belongsToMany('App\Model\Product','products');
    }
}
