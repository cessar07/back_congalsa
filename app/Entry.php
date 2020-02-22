<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DateTime;

class Entry extends Model
{
     public function getDate(){
    	if ($this->publish_at) {
	    	$d = new DateTime($this->publish_at);
	    	return $d->format('d/m/Y');
    	}
    }

    public function getCategory(){
    	return BlogCategory::find($this->category_id);
    }
}
