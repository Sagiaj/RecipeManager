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
        'name', 'email', 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user can have many favorite recipes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites() {
        return $this->belongsToMany(Recipe::class)->withTimeStamps();
    }
    /**
     * A user can have many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
