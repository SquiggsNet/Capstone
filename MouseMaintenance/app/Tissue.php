<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tissue extends Model
{
    protected $fillable = array('name', 'active');

    public function boxes(){
        return $this->belongsTo(Box::class);
    }
}
