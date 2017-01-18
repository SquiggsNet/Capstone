<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tissue extends Model
{
    public function storages(){
        return $this->belongsTo(Storage::class);
    }
}
