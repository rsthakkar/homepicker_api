<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
	
Route::get('get_cities', 'API\CityController@show_cities');

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	//userapis
	Route::post('logout', 'API\UserController@logout');
	Route::get('details', 'API\UserController@details');
	Route::post('update', 'API\UserController@update');

	//ad apis
	Route::post('add_ad', 'API\AdvertisementController@insert_ad');
	Route::get('get_all_ad', 'API\AdvertisementController@get_all_ad');
	Route::get('get_cat_ad/{cat}', 'API\AdvertisementController@get_cat_ad');
	Route::get('get_id_ad/{id}', 'API\AdvertisementController@get_id_ad');
	Route::post('get_search_ad', 'API\AdvertisementController@ad_search');
	Route::get('my_ads', 'API\AdvertisementController@my_ads');
	Route::post('update_ads', 'API\AdvertisementController@update_ads');

	//cities api
	//Route::get('get_cities', 'API\CityController@show_cities');
	Route::post('add_city', 'API\CityController@add_city');

	//area apis
	Route::get('get_areas/{city_id}', 'API\AreaController@get_areas');
	Route::get('get_areas_count', 'API\AreaController@get_areas_count');
	Route::post('add_area', 'API\AreaController@add_area');
	
	//rules apis
	Route::get('get_all_rules','API\RuleController@get_all_rules');

	//amenity apis
	Route::get('get_all_amenities','API\AmenityController@get_all_amenities');
	Route::post('add_amenity','API\AmenityController@add_amenity');
	Route::post('add_ad_amenity','API\AdAmenityController@add_ad_amenity');	

	//image api
	// Route::post('images','API\ImageController@insert_image');

	//review api
	Route::post('add_review','API\ReviewController@add_review');	
	Route::get('show_reviews/{ad_id}','API\ReviewController@show_reviews1');

	//payment apis
	Route::post('add_payment','API\PaymentController@add_payment');	

});