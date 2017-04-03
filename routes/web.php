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

Route::get('/register/validation/{token}', [
    'as' => 'validation', 'uses' => 'IndexController@verify'
]);

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('/join/event/{id?}', 'IndexController@store');
	
	Route::get('/cancel/event/{id}', 'IndexController@update');

	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
	    Route::group(['prefix' => 'admin'], function(){

	    	Route::resource('/department', 'DepartmentController');
	    	
			Route::resource('/student', 'StudentController');

			Route::resource('/event', 'EventController');

			Route::resource('/staff', 'StaffController');

	    	Route::get('/attendance', 'EventAttendanceController@index');

			Route::get('/attendance/signin/{id}', 'EventAttendanceController@signIn');

			Route::get('/attendance/signout/{id}', 'EventAttendanceController@signOut');

			Route::post('/event/signin/{id}/{token}', 'EventAttendanceController@signInStore');

			Route::post('/event/signout/{id}/{token}', 'EventAttendanceController@signOutStore');

			Route::resource('/payment', 'ConfirmationController', ['only' => [
			    'index', 'show'
			]]);

			Route::get('/payment/voucher/{id}', 'ConfirmationController@create');

			Route::post('/payment/confirmation/{id}/{paid?}', 'ConfirmationController@update');
	    });
	});
});
