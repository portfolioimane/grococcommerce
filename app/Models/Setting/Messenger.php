<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger.php extends Model
{
    use HasFactory;
    protected $table = "messengers";
    protected $fillable = ['app_id'];
}
