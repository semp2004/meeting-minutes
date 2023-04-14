<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Besluit extends Model
{
    public function item()
    {
        return $this->belongsTo(AgendaItem::class);
    }
    protected $fillable = [
        'besluit'
    ];
}
