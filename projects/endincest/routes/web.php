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

Route::get('/', function () {
		return view('welcome');
	});

Route::get('/home', function () {
		return view('welcome');
	});

Route::get('gmap', 'GoogleMapController@create_map')->name('gmap');

Route::post('location_coords', 'GoogleMapController@location_coords')->name('location_coords');

Route::get('cropimage', 'ImageController@index')->name('cropimage');
Route::post('upload', 'ImageController@upload')->name('upload');
Route::get('export_csv', 'Admin\ExportController@export_csv')->name('export_csv');
Route::get('ExportView', 'Admin\ExportController@ExportView')->name('ExportView');
Route::get('export_pdf', 'Admin\ExportController@export_pdf')->name('export_pdf');
Route::get('/admin/admindash', 'Admin\AdminController@admindash')->middleware(['auth', 'auth.admin'])->name('admin');
Route::get('user/userdash', 'User\UserController@userdash')->name('user');
Route::get('/profile', 'Profile\ProfileController@index')->name('profile');
Route::get('/editprofile', 'Profile\ProfileController@editprofile')->name('editprofile');
Route::patch('/updateprofile', 'Profile\ProfileController@updateprofile')->name('updateprofile');
Route::get('/viewimage', 'Profile\ProfileController@viewimage')->name('viewimage');
Route::post('/addimage', 'Profile\ProfileController@addimage')->name('addimage');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/changepassword', 'Profile\ProfileController@showChangePasswordForm');
Route::post('/changepassword', 'Profile\ProfileController@changePassword')->name('changePassword');
Route::get('/eventform', 'Admin\AdminController@eventform')->name('eventform');
Route::post('/addevent', 'Admin\AdminController@addevent')->name('addevent');

Route::get('/eventschedule', 'Admin\AdminController@eventschedule')->name('events');
Route::delete('/destroyevent/{id}', 'Admin\AdminController@destroy')->name('destroyevent');
Route::get('/editevent/{id}', 'Admin\AdminController@editeventform')->name('editevent');
Route::patch('/updateevent/{id}', 'Admin\AdminController@updateevent')->name('updateevent');

// Facebook socialite
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('fblogin');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
//Route::get('login/facebook/callback', 'Auth\LoginController@redirectTo');

//Google Login using socialite
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle')->name('googlelogin');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

//Google Login using google API Client
Route::get('auth/google/callback', 'Auth\LoginController@googlelogin')->name('glogin');
Route::get('feeds', 'FeedController@feeds');

//Mesage section
Route::get('/messages', 'MessageController@show')->name('messages');
Route::post('/storePhoneNumber', 'MessageController@storePhoneNumber')->name('storePhoneNumber');
Route::post('/custom', 'MessageController@sendCustomMessage');

//paypal section

Route::get('/order', 'PaypalController@index')->name('order');
Route::post('payment', 'PaypalController@payment')->name('payment');
Route::get('cancel', 'PaypalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PaypalController@success')->name('payment.success');