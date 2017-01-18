<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    //one-to-many relationships
    //User
    public function users(){
        return $this->belongsTo(User::class);
    }

    //many-to-many relationships
    //Mouse
    public function mice(){
        return $this->belongsToMany(Mouse::class);
    }
}
