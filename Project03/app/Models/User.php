<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'bio',
        'profession',
        'phone',
        'city',
        'country',
        'CV',
        'photo',
        'not_target_pref',
        'not_topic_pref',
        'email',
        'password'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role->name === $roleName;
    }


    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function connections()
    {
        return $this->belongsToMany(User::class, 'connections', 'user_id', 'friend_id');
    }


    public function connectedBy()
    {
        return $this->belongsToMany(User::class, 'connections', 'friend_id', 'user_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function favoriteBlogs()
    {
        return $this->belongsToMany(Blog::class, 'favorites', 'user_id', 'blog_id');
    }

    public function likedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_likes', 'user_id', 'blog_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function likedComments()
    {
        return $this->belongsToMany(BlogComment::class, 'comment_likes', 'user_id', 'blog_comment_id');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'brought_tickets');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
