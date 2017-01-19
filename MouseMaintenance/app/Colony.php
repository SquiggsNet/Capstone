<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colony extends Model
{
    protected $fillable = array('name');

    public function mice(){
        return $this->hasMany(Mouse::class);

    }
}
