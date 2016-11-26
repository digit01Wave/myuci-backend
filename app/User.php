<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

     protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRememberToken(){
    return $this->remember_token;
    }

    public function setRememberToken($remember_token){
        $this->remember_token=$remember_token;
    }

    public function getRememberTokenName(){
        return 'remember_token';
    }
}
