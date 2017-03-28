<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    protected $fillable = array('title');

    public function mice()
    {
        return $this->belongsToMany(Mouse::class);
    }
}
