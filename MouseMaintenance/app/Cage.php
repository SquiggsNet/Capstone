<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{

    protected $fillable = array('male', 'female_one', 'female_two', 'female_three', 'room_num');

    public function mice(){
        return $this->hasMany(Mouse::class);
    }
}
