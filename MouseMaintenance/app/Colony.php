<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colony extends Model
{
    public function mice(){
        return $this->hasMany(Mouse::class);

    }
}
