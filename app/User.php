<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm_code',
        'activated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'confirm_code',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'activated' => 'boolean',
    ];

    /* Relationships */
    public function articles() {
        return $this->hasMany(Article::class);
    }

    /* Query Scopes */
    public function scopeSocialUser(\Illuminate\Database\Eloquent\Builder $query, $email)
    {
        return $query->whereEmail($email)->whereNull('password');
    }

    public function isAdmin()
    {
        return ($this->id === 1) ? true : false;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
