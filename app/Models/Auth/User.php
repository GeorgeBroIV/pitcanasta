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
        'username',
        'firstname',
        'lastname',
        'displayname',
        'email',
        'avatar',
        'password',
        'active',
        'notes',
    ];

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
    
    
    /* Custom User Methods
     *  https://stackoverflow.com/questions/32437384/laravel-custom-user-specific-functions
     */
    
    /**
     * Usage: Auth()->user()->isVerified() (boolean)
     *
     * @return boolean
     */
    public function isVerified()
    {
        $verified = false;
        if(in_array($this->attributes['role'], $this->rolesVerified)) {
            $verified = true;
        }
        return $verified;
    }
    
}
