<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'template_id',
        'planned_time',
        'meeting_participants'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
