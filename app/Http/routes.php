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


Route::group(['domain' => getenv('APP_DOMAIN')], function()
{
	Route::get('/',['as' => 'home','uses' => 'PagesController@getHome']);
	Route::get('about',['as' => 'about','uses' => 'PagesController@getAbout']);
	Route::get('pricing',['as' => 'pricing','uses' => 'PagesController@getPricing']);
	Route::get('support',['as' => 'support','uses' => 'PagesController@getSupport']);
	Route::get('contact',['as' => 'contact','uses' => 'PagesController@getContact']);

	Route::get('maps','PagesController@getMap');
		

	Route::get('accounts/register', [ 'as' => 'auth.getRegister', 'uses' => 'AuthController@getRegister' ]);
	Route::post('accounts/register', ['as' => 'auth.postRegister','uses' => 'AuthController@postRegister']);
	Route::get('auth/register/verify/{confirmationCode}',['as' => 'auth.register.confirm','uses' => 'AuthController@confirm']);

	Route::get('auth/verification/resend',['as' => 'auth.verification.getResend','uses' => 'AuthController@getResend']);
	Route::post('auth/verification/resend',['as' => 'auth.verification.postResend','uses' => 'AuthController@postResend']);

});

Route::group(['domain' => '{domain}.' . env('APP_DOMAIN','helpsmile.dev'),'before' => 'verify-domain'], function()
{
	Route::get('/',function($domain){ return redirect()->route('auth.getLogin',$domain); });

	//Route::controller('password', 'RemindersController');

	# Authentication and registration routes
	Route::get('accounts/login', [ 'as' => 'auth.getLogin', 'uses' => 'AuthController@getLogin' ]);
	Route::post('accounts/login', ['as' => 'auth.postLogin','uses' => 'AuthController@postLogin']);

	Route::get('accounts/logout', [ 'as' => 'auth.logout', 'uses' => 'AuthController@getLogout' ]);

});
