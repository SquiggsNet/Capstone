<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = array('title', 'drug_amount');

    public function mice()
    {
        return $this->belongsToMany('App\Mouse')->withPivot('dosage');
    }
}
