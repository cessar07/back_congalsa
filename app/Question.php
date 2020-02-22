<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function getOpt(){
    	return $this->hasMany('App\Option');
    }
}
