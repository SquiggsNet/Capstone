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

Route::get('/appManagement', function () {
    return view('appManagement.index');
});

Route::resource('users', 'UserController');
Route::resource('privileges', 'PrivilegeController');

Route::resource('bloodPressures', 'BloodPressureController');
Route::resource('cages', 'CageController');
Route::resource('colonies', 'ColonyController');

Route::get('mice/{source}', 'MouseController@createSource');
Route::resource('mice', 'MouseController');


Route::resource('storages', 'StorageController');
Route::resource('surgeries', 'SurgeryController');
Route::resource('tags', 'TagController');
Route::resource('tissues', 'TissueController');
Route::resource('treatments', 'TreatmentController');
Route::resource('weights', 'WeightController');



