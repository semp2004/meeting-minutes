<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class template extends Model
{
    protected $table = 'templates';
    protected $fillable = ['user_id', 'name', 'header', 'points'];

}
