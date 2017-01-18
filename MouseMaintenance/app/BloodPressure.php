<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodPressure extends Model
{
    public function mice(){
        return $this->belongsTo(Mouse::class);
    }
}
