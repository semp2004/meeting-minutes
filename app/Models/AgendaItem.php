<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaItem extends Model
{
    use HasFactory;

    protected $table = 'agenda_items';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'meeting_id',
        'content',
        'category',
        'finish_date',
    ];

}
