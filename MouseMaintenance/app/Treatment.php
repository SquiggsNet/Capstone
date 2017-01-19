<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = array('mouse_id', 'title', 'drug_amount');

    public function mice(){
        return $this->belongsTo(Mouse::class);
    }
}
