<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    public function mice(){
        $this->belongsTo(Mouse::class);
    }
}
