<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    public function mice(){
        return $this->belongsTo(Mouse::class);
    }
}
