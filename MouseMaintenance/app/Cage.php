<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{
    public function mice(){
        $this->hasMany(Mouse::class);
    }
}
