<?php


Route::group(['middleware' => ['web']], function() {

	Route::get('google', 'AuthController@redirectToProvider');

	Route::get('google/callback', 'AuthController@handleProviderCallback');

	Route::get('/', 'CategoryController@mainCategories');

	Route::get('categories/{id}', 'CategoryController@index');

	Route::get('recipes/{id}', 'RecipeController@index');

	Route::get('login', 'Auth\LoginController@index');

} );
