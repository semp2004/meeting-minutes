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
    protected $casts = [
        'planned_time' => 'datetime:Y-m-d h:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function persons()
    {
        return $this->belongsToMany(User::class, 'user_meetings', 'meeting_id', 'user_id');
    }
    public function agendaItems()
    {
        $data = \DB::table('agenda_items')
            ->join('users', 'agenda_items.user_id', '=', 'users.id')
            ->select('users.name', 'agenda_items.content', 'agenda_items.category', 'agenda_items.finish_date')
            ->where('agenda_items.meeting_id', $this->id)
            ->get()
            ->toArray();

        return $data;
    }

}
