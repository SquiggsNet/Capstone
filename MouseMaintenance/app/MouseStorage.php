<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MouseStorage extends Model
{
    protected $fillable = array('mouse_id','box_id','tissue_id');

    public function mouse(){
        return $this->belongsTo(Mouse::class);
    }

    public function box(){
        return $this->belongsTo(Box::class);
    }

    public function tissue(){
        return $this->belongsTo(Tissue::class);
    }
}
