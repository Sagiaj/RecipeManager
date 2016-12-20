<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /**
	 * An ingredient can belong to many recipes.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function recipes() {
    	return $this->belongsToMany(Recipe::class)->withTimeStamps();
    }

    public function addIngredient(Ingredient $ingredient){
    	$ingredient->save();
    	return $ingredient;
    }
}
