<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInfo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'general_info';

    protected $fillable = [
        'hero_image',
        'hero_title',
        'logo',
        'email',
        'address',
        'instagram',
        'facebook',
        'youtube',
        'linkedin'
    ];
}
