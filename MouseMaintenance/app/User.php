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
        'first_name', 'last_name', 'student_id', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullName(){
        $fullName = $this->first_name." ".$this->last_name;
        return $fullName;
    }

    public function formatPhone(){
        $p = $this->phone;
        $phoneNum = "(" . substr($p, 0, 3) . ")" . substr($p, 3, 3) . "-" . substr($p, 6);
        return $phoneNum;
    }

    //one-to-many relationships
    //Mouse
    public function mice(){
        return $this->hasMany(Mouse::class);
    }

    //Surgery
    public function surgeries(){
        return $this->hasMany(Surgery::class);
    }

    //many-to-many relationships
    //Privilege
    public function privileges() {
        return $this->belongsToMany(Privilege::class);
    }
}
