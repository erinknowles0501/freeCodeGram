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
        'name', 'email', 'username', 'password', 'image',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    ///
    /*
        A so-called 'Eloquent model event' - there are several of them, called at various times during the User's lifecycle.
        
        This particular function is being called to give Users a profile right away, and give the Title field their username.
    */
    ///
    
    protected static function boot() {
        parent::boot();
        
        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
            ]);
        });
    }
    
    ///
    /*
    Connect Post and Profile to User - note this also has a similar action in Post and Profile models for it to work. Looks like:
    return $this->belongsTo(User::class);
    
    hasMany is so it expects multiple posts to be associated - hasOne is so it just expects one.
    */
    ///
    
    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }
    
    public function profile() {
        return $this->hasOne(Profile::class);
    }
}
