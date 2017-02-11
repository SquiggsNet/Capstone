<?php

namespace App;

//use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;

class Mouse extends Model
{
    protected $fillable = array('colony_id', 'reserved_for', 'sex', 'geno_type_a', 'geno_type_b', 'father', 'mother_one',
                                'mother_two', 'mother_three', 'birth_date', 'wean_date', 'end_date', 'sick_report', 'comments');

    public function getGeno($geno){
        if($geno == 'True' || $geno == 1){
            return '+';
        }else{
            return '-';
        }
    }

    public function getGender($sex){
        if($sex == 'True' || $sex == 1){
            return 'M';
        }else{
            return 'F';
        }
    }

    public function  tagPad($tag_num){
        $tagNum = str_pad($tag_num, 3, '00', STR_PAD_LEFT);
        return $tagNum;
    }


    public function getAge($birth_date){

        $currentDate = Carbon::now('America/Halifax')->format('d-m-y');


        $age = ($currentDate - $birth_date)/7;


//        $age = date_diff(DateTime::createFromFormat('d-m-y', $currentDate),DateTime::createFromFormat('d-m-y', $currentDate));
//        $birthDate = Carbon::parse($birth_date);
//        $age = $birth_date->DiffInWeeks($currentDate);

//        return $currentDate;
//        return $birth_date;
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

    public function mother_three_record(){
        return $this->belongsTo(Mouse::class, 'mother_three');
    }

    public function offspring(){
        return $this->hasMany(Mouse::class);
    }
}
