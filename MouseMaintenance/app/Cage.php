<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{

    protected $fillable = array('room_num', 'mouse_id', 'breeder');

    public function mice(){
        return $this->hasMany(Mouse::class);
    }
}
