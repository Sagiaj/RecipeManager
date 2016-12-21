<?php


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('categories/delete', 'CategoryController@destroy');

Route::post('recipes/{id}', 'FavoriteController@store');

Route::post('recipes/{id}/delete', 'FavoriteController@destroy');

Route::get('profile', 'UserController@index');

Route::post('profile', 'FavoriteController@destroy');

Route::get('login', 'Auth\LoginController@index');

Route::get('logout', 'AuthController@logout');

Route::group(['middleware' => ['web']], function() {

	Route::get('/', 'PageController@index');

	Route::get('categories/{id}', 'CategoryController@index');

	Route::post('categories/store', 'CategoryController@store');

	Route::get('recipes/{id}', 'RecipeController@index');

	Route::post('recipes/{id}/store', 'CommentController@store');

	Route::post('categories/{id}/addRecipe', 'RecipeController@store');
	
});

//I left google routes & implementation here so that I can ask you questions that refer to it
Route::get('google', 'AuthController@redirectToProvider');

Route::get('google/callback', 'AuthController@handleProviderCallback'); 


