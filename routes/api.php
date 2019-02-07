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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('lists', 'ListsController@index')->middleware('auth:api');
Route::get('lists/{list}', 'ListsController@show')->middleware('auth:api');
Route::post('lists', 'ListsController@store')->middleware('auth:api');

Route::get('countries', 'CitiesController@indexCountries')->middleware('auth:api');
Route::get('cities', 'CitiesController@index')->middleware('auth:api');
Route::get('developers', 'DevelopersController@index')->middleware('auth:api');

//these are for simple testing with curl or insomnia
Route::get('notProtectedLists', 'ListsController@index');
Route::get('notProtectedLists/{list}', 'ListsController@show');
Route::post('notProtectedLists', 'ListsController@store');
Route::get('notProtectedCountries', 'CitiesController@indexCountries');
Route::get('notProtectedCities', 'CitiesController@index');
Route::get('notProtectedDevelopers', 'DevelopersController@index');
