<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'img',
        'profession',
        'linkedin',
        'instagram',
        'facebook',
        'twitter'

    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_speaker');
    }
}
