<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));


	//Route::get('home', 'HomeController@index');

	Route::get('users', 'UsersController@index');
	Route::get('users/{users}', 'UsersController@show');
	Route::get('my-account', 'UsersController@edit');
	Route::put('users/{users}', 'UsersController@update');
	Route::patch('users/{users}', 'UsersController@update');
	Route::delete('users/{users}', 'UsersController@destroy');
	Route::get('/{language}', 'HomeController@changeLanguage');
	//Route::get('dishes', 'DishesController@index');
	//Route::get('dishes/create', 'DishesController@create');
	//Route::get('dishes/{id}', 'DishesController@show');
	//Route::post('dishes', 'DishesController@store');
	//Route::get('dishes/{id}/edit', 'DishesController@edit');
	Route::get('dishes/view-cart', 'DishesController@viewCart');
	Route::resource('dishes', 'DishesController');
	Route::post('dishes/{dishes}/add-to-cart', 'DishesController@addToCart');
	//Route::get('dishes/{dishes}/{isBeingOrdered}', 'DishesController@show');

	Route::resource('orders', 'OrdersController');
	Route::get('orders/{orders}/accept', 'OrdersController@accept');
	Route::get('orders/{orders}/reject', 'OrdersController@reject');
	Route::get('orders/{orders}/cancel', 'OrdersController@cancel');

	Route::resource('reviews', 'ReviewsController');

	Route::get('search/{googlePlaceId}', 'HomeController@search');

	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);

});
