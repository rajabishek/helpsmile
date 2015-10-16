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

	Route::group(['namespace' => 'Auth'], function()
	{
		Route::get('accounts/register', [ 'as' => 'auth.getRegister', 'uses' => 'AuthController@getRegister' ]);
		Route::post('accounts/register', ['as' => 'auth.postRegister','uses' => 'AuthController@postRegister']);
		Route::get('auth/register/verify/{confirmationCode}',['as' => 'auth.register.confirm','uses' => 'AuthController@confirm']);

		Route::get('auth/verification/resend',['as' => 'auth.verification.getResend','uses' => 'AuthController@getResend']);
		Route::post('auth/verification/resend',['as' => 'auth.verification.postResend','uses' => 'AuthController@postResend']);
	});
});

Route::group(['domain' => '{domain}.' . env('APP_DOMAIN','helpsmile.dev'),'before' => 'verify-domain'], function()
{
	Route::get('/',function($domain){ return redirect()->route('auth.getLogin',$domain); });
	
	Route::group(['namespace' => 'Auth'], function()
	{
		// Password reset link request routes...
		Route::get('password/email', 'PasswordController@getEmail');
		Route::post('password/email', 'PasswordController@postEmail');

		// Password reset routes...
		Route::get('password/reset/{token}', 'PasswordController@getReset');
		Route::post('password/reset', 'PasswordController@postReset');

	    Route::get('accounts/login', [ 'as' => 'auth.getLogin', 'uses' => 'AuthController@getLogin' ]);
		Route::post('accounts/login', ['as' => 'auth.postLogin','uses' => 'AuthController@postLogin']);

		Route::get('accounts/logout', [ 'as' => 'auth.logout', 'uses' => 'AuthController@getLogout' ]);
	});

	Route::group(['prefix' => 'admin', 'namespace' => 'Admin' ],function() {

	    Route::get('users/import',['as' => 'admin.users.getImport','uses' => 'UsersController@getImport']);
	    Route::post('users/import',['as' => 'admin.users.postImport','uses' => 'UsersController@postImport']);
	    Route::get('users/download',['as' => 'admin.users.getDownload','uses' => 'UsersController@getDownload']);
	    Route::post('users/download',['as' => 'admin.users.postDownload','uses' => 'UsersController@postDownload']);
	    Route::resource('users', 'UsersController');
	    Route::get('webhooks/json', ['as' => 'admin.webhooks.json', 'uses' => 'WebhooksController@getWebhooks']);
	    Route::resource('webhooks', 'WebhooksController');

	    Route::post('settings/changePassword',['as' => 'admin.settings.changePassword','uses' => 'SettingsController@changePassword']);
		Route::post('settings/changeProfile',['as' => 'admin.settings.changeProfile','uses' => 'SettingsController@changeProfile']);
	    Route::resource('settings', 'SettingsController',['only' => ['index','store']]);
	});

});
