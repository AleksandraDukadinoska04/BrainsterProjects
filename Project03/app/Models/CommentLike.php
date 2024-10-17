<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_comment_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function comment()
    {
        return $this->belongsTo(BlogComment::class, 'blog_comment_id');
    }
}
