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

//Admin section ###

Route::namespace ("Admin")->prefix('admin')->group(function () {
		Route::get('/', 'AdminController@admindash')->name('admin.admindash');
		Route::namespace ('Auth')->group(function () {
				Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
				Route::post('/login', 'LoginController@login');
				Route::post('logout', 'LoginController@logout')->name('admin.logout');

			});
	});

Route::get('gmap', 'GoogleMapController@create_map')->name('gmap');

Route::post('location_coords', 'GoogleMapController@location_coords')->name('location_coords');

Route::get('cropimage', 'ImageController@index')->name('cropimage');
Route::post('upload', 'ImageController@upload')->name('upload');
Route::get('export_csv', 'Admin\ExportController@export_csv')->name('export_csv');
Route::get('ExportView', 'Admin\ExportController@ExportView')->name('ExportView');
Route::get('export_pdf', 'Admin\ExportController@export_pdf')->name('export_pdf');

Route::get('/profile', 'Profile\ProfileController@index')->name('profile');
Route::get('/editprofile', 'Profile\ProfileController@editprofile')->name('editprofile');
Route::patch('/updateprofile', 'Profile\ProfileController@updateprofile')->name('updateprofile');
Route::get('/viewimage', 'Profile\ProfileController@viewimage')->name('viewimage');
Route::post('/addimage', 'Profile\ProfileController@addimage')->name('addimage');
Route::get('/changepassword', 'Profile\ProfileController@showChangePasswordForm');
Route::post('/changepassword', 'Profile\ProfileController@changePassword')->name('changePassword');
Route::get('/eventform', 'Admin\AdminController@eventform')->name('eventform');
Route::post('/addevent', 'Admin\AdminController@addevent')->name('addevent');

Route::get('/eventschedule', 'Admin\AdminController@eventschedule')->name('events');
Route::delete('/destroyevent/{id}', 'Admin\AdminController@destroy')->name('destroyevent');
Route::get('/editevent/{id}', 'Admin\AdminController@editeventform')->name('editevent');
Route::patch('/updateevent/{id}', 'Admin\AdminController@updateevent')->name('updateevent');
//Mesage section
Route::get('/messages', 'MessageController@show')->name('messages');
Route::post('/storePhoneNumber', 'MessageController@storePhoneNumber')->name('storePhoneNumber');
Route::post('/custom', 'MessageController@sendCustomMessage');

//paypal section

Route::get('/order', 'PaypalController@index')->name('order');
Route::post('payment', 'PaypalController@payment')->name('payment');
Route::get('cancel', 'PaypalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PaypalController@success')->name('payment.success');

//whatsapp section
Route::get('/whatsapp', 'WhatsappController@index')->name('whatsapp');
Route::get('/group', 'WhatsappController@group')->name('group');
Route::post('/message', 'WhatsappController@sendMessage')->name('message');
Route::get('/welcome', 'WhatsappController@welcome')->name('welcome');

//Import section

Route::get('/import', 'ImportController@import_form')->name('import');
Route::post('/import_file', 'ImportController@import_file')->name('import_file');

//paytm section
Route::get('eventRegistration', 'OrderController@register')->name('event_registration');
Route::post('paytmPayment', 'OrderController@order')->name('paytm');
Route::post('payment/status', 'OrderController@paymentCallback');

//Product section
Route::resource('products', 'ShoppingController');

//Coupon Section
Route::resource('coupons', 'CouponController');

Route::get('/', function () {
		return view('welcome');
	});

Route::get('/home', function () {
		return view('welcome');
	});

//user section  ###

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

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

Route::get('product_view', 'ProductController@product_view')->name('product_view');
Route::get('search', 'ProductController@search')->name('search');
Route::group(['middleware' => 'auth'], function () {

		Route::post('/add_to_cart/{id}', 'ProductController@add_to_cart')->name('add_to_cart');
		Route::post('/add_to_wish_list/{id}', 'ProductController@add_to_wish_list')->name('add_to_wish_list');
		Route::post('/remove_cart/{id}', 'ProductController@remove_cart')->name('remove_cart');
		Route::post('/remove_wish/{id}', 'ProductController@remove_wish')->name('remove_wish');
		Route::get('cart', 'ProductController@cart_view')->name('cart');
		Route::get('wish_list', 'ProductController@wish_list_view')->name('wish_list');
		Route::post('/paypal_payment/{id}', 'ProductController@paypal_payment')->name('paypal_payment');
		Route::get('cancel', 'ProductController@cancel')->name('payment.cancel');
		Route::get('payment/success', 'ProductController@success')->name('payment.success');
		Route::get('/checkout/{id}', 'ProductController@checkout_form')->name('checkout');
		Route::post('/coupon_check/{id}', 'ProductController@coupon_check')->name('coupon_check');
		Route::delete('coupon_remove', 'ProductController@coupon_remove')->name('coupon_remove');

	});