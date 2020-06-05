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