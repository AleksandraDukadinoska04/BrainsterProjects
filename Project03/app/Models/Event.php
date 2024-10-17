<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title_id',
        'img',
        'theme',
        'description',
        'objective',
        'location',
        'date',
        'status'
    ];

    public function eventTitle()
    {
        return $this->belongsTo(EventTitle::class, 'title_id');
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
