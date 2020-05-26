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

Auth::routes(['verify' => true]);

Route::get('/admin', function () {
		return 'you are admin';
	})->middleware(['auth', 'auth.admin']);

Route::namespace ('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function () {
		Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
	});

Route::namespace ('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function () {
		Route::get('admindash', 'AdminController@admindash');
	});

Route::namespace ('User')->prefix('user')->name('user.')->group(function () {
		Route::get('userdash', 'UserController@userdash');
	});
Route::get('/profile', 'Profile\ProfileController@index')->name('profile');
Route::get('/editprofile', 'Profile\ProfileController@editprofile')->name('editprofile');
Route::patch('/updateprofile/{id}', 'Profile\ProfileController@updateprofile')->name('updateprofile');
Route::get('/viewimage', 'Profile\ProfileController@viewimage')->name('viewimage');
Route::post('/addimage', 'Profile\ProfileController@addimage')->name('addimage');