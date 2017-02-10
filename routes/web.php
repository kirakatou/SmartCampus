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
Route::get('/', 'IndexController@index');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/join/event/{id?}', 'IndexController@store');
	Route::get('/cancel/event/{id}', 'IndexController@update');
	
});

Route::get('/alert', function() {
    \Alert::message('Hey!');

    return view('errors.503');
});

Route::resource('/department', 'DepartmentController');

Route::resource('/student', 'StudentController');

Route::resource('/event', 'EventController');

Route::resource('/staff', 'StaffController');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
	    Route::get('/admin', function(){
	        return 'testt';
	    });

	});
});
// Route::get('images/{folder}/{filename}', function ($folder, $filename)
// {
//     return Image::make(storage_path() . '/' . $folder . '/' . $filename)->response();
// });
