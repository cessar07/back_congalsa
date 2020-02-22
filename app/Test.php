<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function getRating(){
    	$t1 = UserTest::where('test_id' , $this->id)->sum('stars');
    	return $t1;
    }
}
