<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actionpoint extends Model
{
    use HasFactory;

    protected $table = "action_points";
    protected $fillable = [
        'title',
        'content',
        'status',
        'assigned_date',
        'completed_date',
        'agenda_item_id',
        'assigned_to',
        'user_id',
    ];

    function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function agendaItem()
    {
        return $this->belongsTo(AgendaItem::class);
    }

    public function actionPoints()
    {
        return $this->hasMany(Actionpoint::class);
    }
}
