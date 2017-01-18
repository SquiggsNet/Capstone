<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{
    public function mice(){
        return $this->hasMany(Mouse::class);
    }
}
