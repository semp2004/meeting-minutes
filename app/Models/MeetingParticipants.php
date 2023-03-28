<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingParticipants extends Model
{
    use HasFactory;

    protected $table = 'user_meetings';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'meeting_id',
    ];
}
