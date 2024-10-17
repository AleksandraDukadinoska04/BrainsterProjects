<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogSection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'blog_id',
        'order',
        'section_title',
        'section_content'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
