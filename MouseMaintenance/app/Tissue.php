<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tissue extends Model
{
    protected $fillable = array('name');

    public function storages(){
        return $this->belongsTo(Storage::class);
    }
}
