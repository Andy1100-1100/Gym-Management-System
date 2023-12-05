<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memberModel extends Model
{
    //use HasFactory;
    public function mytrainer(){
        return $this->hasMany('App\Models\memberModel','id','trainer_id');
    }
}
