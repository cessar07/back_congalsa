<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function getCategory(){
    	return RecipeCategory::find($this->category_id);
    }

    public function getIng(){
    	return $this->hasMany('App\RecipeIngredient');
    }
}
