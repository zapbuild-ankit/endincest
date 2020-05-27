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

Route::get('/admin', function () {
		return 'you are admin';
	})->middleware(['auth', 'auth.admin']);

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
