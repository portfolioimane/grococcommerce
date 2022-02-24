<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;
     public function seo_keyword(){

        return $this->hasMany('App\Model\Setting\SeoKeyword');
    }
}
