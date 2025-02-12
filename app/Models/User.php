<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'userid';
    protected $table = 'users';

    protected $fillable = [
        'username', 
        'password'
    ];

    protected $hidden = [
        'password'
    ];
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}