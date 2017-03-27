<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = array('title', 'drug_amount');

    public function mouse_treatments()
    {
        return $this->belongsTo(MouseTreatment::class);
    }

    public function mice()
    {
        return $this->belongsToMany(Mouse::class);
    }
}
