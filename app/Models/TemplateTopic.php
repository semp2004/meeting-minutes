<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateTopic extends Model
{
    public $timestamps = false;
    protected $table = 'template_topics';

    public $fillable = [
        'template_id',
        'topic',
    ];

    public function agendaItems()
    {
        return $this->hasMany(AgendaItem::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
