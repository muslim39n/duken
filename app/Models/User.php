<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function favoriteAds(){
        return $this->belongsToMany(Ad::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function notices(){
        return $this->hasMany(Notice::class);
    }

    public function isAdmin(){
        foreach($this->roles as $role) {
            if ($role->name == "admin") {
                return true;
            }
        }

        return false;
    }
    public function isModerator(){
        foreach($this->roles as $role) {
            if ($role->name == "moderator") {
                return true;
            }
        }

        return false;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
