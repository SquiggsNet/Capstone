<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public function mice(){
        $this->belongsTo(Mouse::class);
    }
}
