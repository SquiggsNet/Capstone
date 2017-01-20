<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mouse extends Model
{
    protected $fillable = array('colony_id', 'reserved_for', 'sex', 'geno_type_a', 'geno_type_b', 'father', 'mother_one',
                                'mother_two', 'birth_date', 'wean_date', 'end_date', 'sick_report', 'comments');

    //one-to-many relationships
    //Blood pressure
    public function blood_pressures(){
        return $this->hasMany(BloodPressure::class);
    }

    //Treatment
    public function treatments(){
        return $this->hasMany(Treatment::class);
    }

    //Weight
    public function weights(){
        return $this->hasMany(Weight::class);
    }

    //Cage
    public function cages(){
        return $this->belongsTo(Cage::class);
    }

    //Colony
    public function colonies(){
        return $this->belongsTo(Colony::class);
    }

    //User
    public function users(){
        return $this->belongsTo(User::class);
    }

    //many-to-many relationships
    //Surgery
    public function surgeries(){
        return $this->belongsToMany(Surgery::class);
    }

    //Tag
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //Storage
    public function storages(){
        return $this->belongsToMany(Storage::class);
    }

    //recursive relationships
    public function father(){
        return $this->belongsTo(Mouse::class, 'id', 'father');
    }

    public function mother_one(){
        return $this->belongsTo(Mouse::class, 'id', 'mother_one');
    }

    public function mother_two(){
        return $this->belongsTo(Mouse::class, 'id', 'mother_two');
    }

    public function offspring(){
        return $this->hasMany(Mouse::class);
    }
}
