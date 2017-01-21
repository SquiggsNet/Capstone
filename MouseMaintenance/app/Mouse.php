<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mouse extends Model
{
    protected $fillable = array('colony_id', 'reserved_for', 'sex', 'geno_type_a', 'geno_type_b', 'father', 'mother_one',
                                'mother_two', 'birth_date', 'wean_date', 'end_date', 'sick_report', 'comments');

    public function getGeno($geno){
        if($geno == 'True'){
            return '+';
        }else{
            return '-';
        }
    }

    public function getGender($sex){
        if($sex == 'True'){
            return 'M';
        }else{
            return 'F';
        }
    }

    public function getAge($birth_date){
        $currentDate = date("d.m.y");
        $age = $currentDate - $birth_date;
        return $age;
    }

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
    public function colony(){
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
    public function father_record(){
        return $this->belongsTo(Mouse::class, 'father');
    }

    public function mother_one_record(){
        return $this->belongsTo(Mouse::class, 'mother_one');
    }

    public function mother_two_record(){
        return $this->belongsTo(Mouse::class, 'mother_two');
    }

    public function offspring(){
        return $this->hasMany(Mouse::class);
    }
}
