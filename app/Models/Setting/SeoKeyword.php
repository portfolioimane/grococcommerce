<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoKeyword extends Model
{
    use HasFactory;
     public function seo_setting(){

        return $this->belongsTo('App\Model\Setting\SeoSetting');
    }
}
