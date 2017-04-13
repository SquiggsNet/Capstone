<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MouseStorage extends Model
{
    protected $fillable = array('mouse_id','box_id','tissue_id');
}
