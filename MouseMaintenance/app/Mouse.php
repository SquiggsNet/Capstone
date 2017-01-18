<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mouse extends Model
{
    //one-to-many relationships
    //Blood pressure
    public function blood_pressures(){
        $this->hasMany(BloodPressure::class);
    }

    //Treatment
    public function treatments(){
        $this->hasMany(Treatment::class);
    }

    //Weight
    public function weights(){
        $this->hasMany(Weight::class);
    }

    //Cage
    public function cages(){
        $this->belongsTo(Cage::class);
    }

    //Colony
    public function colonies(){
        $this->belongsTo(Colony::class);
    }
}
