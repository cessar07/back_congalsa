<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DateTime;

class Event extends Model
{
    public function getDate(){
    	$d = new DateTime($this->date_from);
    	return $d->format('d-m-Y');
    }

    public function getCount(){
    	return UsersEvent::where('event_id' , $this->id)->where('status' , 1)->count();
    }

    public function getDateFrom(){
    	$d = new DateTime($this->date_from);
    	return $d->format('d/m/Y');
    }

    public function getDateTo(){
    	$d = new DateTime($this->date_to);
    	return $d->format('d/m/Y');
    }

    public function getDiff(){
        switch ($this->difficulty) {
            case 1:
                return 'Facil';
            break;
            case 2:
                return 'Media';
            break;
            case 3:
                return 'Dificil';
            break;
            
            default:
                return '';
            break;
        }
    }
}
