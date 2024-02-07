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


Route::get('/', 'ChildrenController@volunteerView');
Route::post('/contactus', 'ContactController@formSubmit');
Route::post('/volunteer/store', 'VolunteerController@store');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function () {


    Route::get('/volunteer/export', 'VolunteerController@export');
    Route::resource('/volunteer', 'VolunteerController');


    Route::resource('/children', 'ChildrenController');
    Route::get('/children/{id}/delete', 'ChildrenController@softDelete');
    Route::post('/children/{id}/updateOrder', 'ChildrenController@updateOrder');
    Route::get('/children/{volunteerid}/unhook', 'ChildrenController@unhookGranter');

    Route::get('/volunteer/destroy/{id}', 'VolunteerController@destroy');

    Route::resource('/content', 'ContentController');
});

Auth::routes();
