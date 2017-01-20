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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController');
Route::resource('privileges', 'PrivilegeController');
Route::resource('colonies', 'ColonyController');
Route::resource('cages', 'CageController');
Route::resource('treatments', 'TreatmentController');
Route::resource('weights', 'WeightController');
Route::resource('bloodPressures', 'BloodPressureController');
Route::resource('tags', 'TagController');
Route::resource('tissues', 'TissueController');
Route::resource('storages', 'StorageController');