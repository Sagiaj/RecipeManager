<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

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

    /**
     * Deletes a category with a given request info
     */

    public function deleteCategory(Request $request, Category $category) {
        if(isset($category)){
            $recipes = $category->recipes;
            foreach ($recipes as $recipe) {
                $category->recipes()->detach($recipe);
                $recipe->categories()->detach($category);
            }
            $cat = $category;
            $category->delete();
        	return response()->json($cat);
        }


    }
}
