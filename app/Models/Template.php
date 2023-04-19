<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'templates';
    protected $fillable = ['user_id', 'name', 'header'];

    public function topics()
    {
        return $this->hasMany(TemplateTopic::class);
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }
}
