<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
	 * A comment can belong to one user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function user() {
    	return $this->belongsTo(User::class);
    }

    /**
	 * A comment can belong to one recipe.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function recipes() {
    	return $this->belongsTo(Recipe::class);
    }
}
