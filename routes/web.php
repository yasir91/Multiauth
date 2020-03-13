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

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('seller')->group(function(){
	Route::get('/login', 'Auth\SellerLoginController@showLoginForm')->name('seller.login');
	Route::post('/login', 'Auth\SellerLoginController@login')->name('seller.login.submit');
	Route::post('/logout', 'Auth\SellerLoginController@logout')->name('seller.logout');
	Route::get('/', 'Auth\SellerController@index')->name('seller');

	// Password reset routes
	Route::post('/password/email', 'Auth\SellerForgotPasswordController@sendResetLinkEmail')->name('seller.password.email');
	Route::get('/password/reset', 'Auth\SellerForgotPasswordController@showLinkRequestForm')->name('seller.password.request');
	Route::post('/password/reset', 'Auth\SellerResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\SellerResetPasswordController@showResetForm')->name('seller.password.reset');
});
