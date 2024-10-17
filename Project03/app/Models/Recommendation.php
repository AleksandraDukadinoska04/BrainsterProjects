<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommendation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'from_user_id',
        'for_user_id',
        'content'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }


    public function forUser()
    {
        return $this->belongsTo(User::class, 'for_user_id');
    }
}
