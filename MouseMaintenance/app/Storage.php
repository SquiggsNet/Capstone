<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = array('tissue_id', 'type', 'freezer', 'compartment', 'shelf');

    //one-to-many relationships
    //Box
    public function boxes(){
        return $this->hasMany(Box::class);
    }


//    //Tissue
//    public function tissues(){
//        return $this->hasMany(Tissue::class);
//    }
//
//    //many-to-many relationships
//    //Mouse
//    public function mice(){
//        return $this->belongsToMany(Mouse::class);
//    }
}
