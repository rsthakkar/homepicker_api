<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('/', function () {
	    return view('admin/index');
	});

    Route::get('members','PlaceController@show_members');

    Route::get('states','StateController@show_states');
	Route::get('add_state','StateController@add_state');
	Route::get('delete_state/{id}','StateController@destroy');
	Route::get('update_state','StateController@update');

	Route::get('cities', 'CityController@show_cities');
	Route::get('add_city', 'CityController@add_city');
	Route::get('delete_city/{id}','CityController@destroy');
	Route::get('update_city','CityController@update');

	Route::get('categories', 'CategoryController@show_cat');
	Route::get('add_category', 'CategoryController@add_cat');
	Route::get('delete_category/{id}','CategoryController@destroy');
	Route::get('update_category','CategoryController@update');

	Route::get('areas', 'AreaController@show_areas');
	Route::get('add_area', 'AreaController@add_area');
	Route::get('delete_area/{id}','AreaController@destroy');
	Route::get('update_area','AreaController@update');

	Route::get('rules', 'RuleController@show_rules');
	Route::get('add_rule', 'RuleController@add_rule');
	Route::get('delete_rule/{id}','RuleController@destroy');
	Route::get('update_rule','RuleController@update');

	Route::get('ads','AdvertisementController@show_ads');
	Route::get('ad{id}','AdvertisementController@show_ad_id');

});


// Route::get('/home', 'HomeController@index')->name('home');
