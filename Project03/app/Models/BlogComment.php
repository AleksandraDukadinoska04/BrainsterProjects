<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'blog_id',
        'content',
        'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }


    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }


    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'comment_likes', 'blog_comment_id', 'user_id');
    }
}
