<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'website'
    ];
    
    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
