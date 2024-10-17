<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'img',
        'title',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'blog_id', 'user_id');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'blog_likes', 'blog_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function sections()
    {
        return $this->hasMany(BlogSection::class);
    }
}
