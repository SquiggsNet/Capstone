<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function mice(){
        return $this->belongsToMany(Mouse::class);
    }
}
