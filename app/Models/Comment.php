<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'agenda_item_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function agendaItem()
    {
        return $this->belongsTo(AgendaItem::class);
    }
}
