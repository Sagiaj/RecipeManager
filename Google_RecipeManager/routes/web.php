<?php


Route::group(['middleware' => ['web']], function() {

	Route::get('google', 'AuthController@redirectToProvider');

	Route::get('google/callback', 'AuthController@handleProviderCallback');

	Route::get('login', 'Auth\LoginController@index');

	Route::get('logout', 'AuthController@logout');

	Route::get('/', 'PageController@index');

	Route::get('categories/{id}', 'CategoryController@index');

	Route::get('recipes/{id}', 'RecipeController@index');

	Route::post('recipes/{id}', 'FavoriteController@store');

	Route::post('recipes/{id}/delete', 'FavoriteController@destroy');

	Route::post('recipes/{id}/store', 'CommentController@store');

	Route::get('profile', 'UserController@index');

	Route::post('profile', 'FavoriteController@destroy');

} );
