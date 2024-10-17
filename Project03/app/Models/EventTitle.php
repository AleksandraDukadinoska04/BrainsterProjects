<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
