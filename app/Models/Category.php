<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    // relation with subcategory 

    public function sub_category(){

        return $this->hasMany('App\Model\SubCategory');
    }

    // relation with product

    public function product(){

        return $this->hasMany('App\Model\Product');
    }
     
    public function size(){

        return $this->hasOne('App\Model\Size');
    } 
}
