<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
	 * A recipe can be a many users' favorite(belongs to many users).
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users() {
		return $this->belongsToMany(User::class)->withTimeStamps();
	}

	/**
	 * A recipe can belong to many categories.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function categories() {
    	return $this->belongsToMany(Category::class)->withTimeStamps();
    }

    /**
	 * A recipe can have many ingredients.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function ingredients() {
    	return $this->belongsToMany(Ingredient::class)->withTimeStamps();
    }

    /**
	 * A recipe can have many comments.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function comments() {
    	return $this->hasMany(Comment::class);
    }
}
