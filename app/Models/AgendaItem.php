<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaItem extends Model
{
    use HasFactory;

    protected $table = 'agenda_items';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'template_topic_id',
        'content',
        'category',
        'finish_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function meeting()
    // {
    //     return $this->belongsTo(Meeting::class);
    // }

    public function topic()
    {
        return $this->belongsTo(TemplateTopic::class, 'template_topic_id', 'id');
    }

    public function Besluit()
    {
        return $this->hasOne(Besluit::class);
    }

    public function actionPoints()
    {
        return $this->hasMany(Actionpoint::class);
    }
}
