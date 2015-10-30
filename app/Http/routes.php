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

Route::group(['domain' => '{domain}.' . env('APP_DOMAIN','helpsmile.dev'),'middleware' => 'verify-domain'], function()
{
	Route::get('/',function($domain){ return redirect()->route('auth.getLogin',$domain); });
	
	Route::group(['namespace' => 'Auth'], function()
	{
		Route::get('password/email', ['as' => 'password.getEmail', 'uses' => 'PasswordController@getEmail']);
		Route::post('password/email', ['as' => 'password.postEmail','uses' => 'PasswordController@postEmail']);

		Route::get('password/reset/{token}', ['as' => 'password.getReset','uses' => 'PasswordController@getReset']);
		Route::post('password/reset', ['as' => 'password.postReset','uses' => 'PasswordController@postReset']);

	    Route::get('accounts/login', [ 'as' => 'auth.getLogin', 'uses' => 'AuthController@getLogin' ]);
		Route::post('accounts/login', ['as' => 'auth.postLogin','uses' => 'AuthController@postLogin']);

		Route::get('accounts/logout', [ 'as' => 'auth.logout', 'uses' => 'AuthController@getLogout' ]);
	});

	Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'designation:Admin'],function() 
	{
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

	Route::group(['prefix' => 'teamleader', 'namespace' => 'Teamleader', 'middleware' => 'designation:Team Leader'],function()
	{
		Route::get('notifications',['as' => 'teamleader.notifications','uses' => 'DonationsController@notifications']);
		
		Route::post('donors/{id}/donations',['as' => 'teamleader.donors.donations.store','uses' => 'DonationsController@saveDonation']);
		Route::get('donors/{id}/donations/create',['as' => 'teamleader.donor.donations.create','uses' => 'DonationsController@addDonation']);
		Route::resource('donors', 'DonorsController',['only' => ['index','show','destroy','update']]);
		Route::resource('donations', 'DonationsController');
		Route::post('settings/changePassword',['as' => 'teamleader.settings.changePassword','uses' => 'SettingsController@changePassword']);
		Route::post('settings/changeProfile',['as' => 'teamleader.settings.changeProfile','uses' => 'SettingsController@changeProfile']);
	    Route::resource('settings', 'SettingsController',['only' => ['index','store']]);
	});

	Route::group(['prefix' => 'fieldcoordinator', 'namespace' => 'Fieldcoordinator', 'middleware' => 'designation:Field Coordinator'],function() {
		
		Route::post('donations/{id}/assign',[
			'as' => 'fieldcoordinator.donations.postAssign',
			'uses' => 'DonationsController@postAssign'
		]);

		Route::get('donations/pending/timeline',[
			'as' => 'fieldcoordinator.donations.getPendingInTimeline',
			'uses' => 'DonationsController@getPendingInTimeline'
		]);
		
		Route::get('donations/pending',[
			'as' => 'fieldcoordinator.donations.getPending',
			'uses' => 'DonationsController@getPending'
		]);

		Route::get('donations/donated',[
			'as' => 'fieldcoordinator.donations.getDonated',
			'uses' => 'DonationsController@getDonated'
		]);

		Route::get('donations/disinterested',[
			'as' => 'fieldcoordinator.donations.getDisinterested',
			'uses' => 'DonationsController@getDisinterested'
		]);

		Route::get('notifications',[
			'as' => 'fieldcoordinator.notifications',
			'uses' => 'DonationsController@notifications'
		]);
		
		Route::resource('donations', 'DonationsController',['except' => 'create','store']);
		Route::resource('donors', 'DonorsController',['only' => ['index','show','destroy','update']]);

		Route::post('settings/changePassword',['as' => 'fieldcoordinator.settings.changePassword','uses' => 'SettingsController@changePassword']);
		Route::post('settings/changeProfile',['as' => 'fieldcoordinator.settings.changeProfile','uses' => 'SettingsController@changeProfile']);
	    Route::resource('settings', 'SettingsController',['only' => ['index','store']]);
	});

	Route::group(['prefix' => 'manager', 'namespace' => 'Manager', 'middleware' => 'designation:Manager'],function()
	{		
		Route::get('dashboard',['as' => 'manager.dashboard.index','uses' => 'DashboardController@index']);
		Route::get('dashboard/reporting',['as' => 'manager.dashboard.reporting','uses' => 'DashboardController@reporting']);
		Route::get('dashboard/notifications',['as' => 'manager.dashboard.notifications','uses' => 'DashboardController@notifications']);
		Route::get('telecallers',['as' => 'manager.telecallers.index','uses' => 'EmployeesController@telecallers']);
		Route::get('teamleaders',['as' => 'manager.teamleaders.index','uses' => 'EmployeesController@teamleaders']);
		Route::get('fieldexecutives',['as' => 'manager.fieldexecutives.index','uses' => 'EmployeesController@fieldexecutives']);
		Route::post('settings/changePassword',['as' => 'manager.settings.changePassword','uses' => 'SettingsController@changePassword']);
		Route::post('settings/changeProfile',['as' => 'manager.settings.changeProfile','uses' => 'SettingsController@changeProfile']);
	    Route::resource('settings', 'SettingsController',['only' => ['index','store']]);
	});

	Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\v1'], function () 
	{    
	    Route::post('accounts/login', ['as' => 'api.v1.auth.postLogin','uses' => 'AuthController@postLogin']);
	    Route::get('fieldexecutives/{fieldexecutiveId}/donations/{donationId}',['uses' => 'Fieldexecutive\DonationsController@show']);
	    Route::get('fieldexecutives/{fieldexecutiveId}/donations',['uses' => 'Fieldexecutive\DonationsController@index']);
	    Route::put('fieldexecutives/{fieldexecutiveId}/donations/{donationId}',['uses' => 'Fieldexecutive\DonationsController@update']);
	});

});
