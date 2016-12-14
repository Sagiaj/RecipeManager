<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
	 * A category can have many recipes.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function recipes() {
    	return $this->belongsToMany(Recipe::class)->withTimeStamps();
    }
}
