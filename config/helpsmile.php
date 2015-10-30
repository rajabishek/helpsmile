<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Add the curresponding email addresses for the respective categories
	|--------------------------------------------------------------------------
	|
	| Here you can add the email addresses for the contact form
	|
	*/

	'listeners' => [

		'Helpsmile\Listeners\NotificationsListener',
		'Helpsmile\Listeners\WebhooksListener',
		'Helpsmile\Listeners\EmailNotifier',
	],

	/*
	|--------------------------------------------------------------------------
	| Add the curresponding email addresses for the respective categories
	|--------------------------------------------------------------------------
	|
	| Here you can add the email addresses for the contact form
	|
	*/

	'email' => [

		'address' => '45, Okhla Industrial Estate, Phase III New Delhi – 110 020.',
		'phone' => '+91 11 65955511',
		'email' => 'supportusindia@Helpsmile.org',
		'domain' => 'www.Helpsmileindia.in',
		'facebook' => 'https://www.facebook.com/HelpsmileIndia',
		'twitter' => 'https://twitter.com/Helpsmilein',
		'googleplus' => 'https://plus.google.com/101851084744269228094/posts',
		'pininterest' => 'https://www.pinterest.com/HelpsmileIN',
		'youtube' => 'https://www.youtube.com/user/HelpsmileIN',
		'rss' => 'www.Helpsmileindia.in',

		'about' => 'http://www.Helpsmileindia.in/us',
		'motive' => 'http://www.Helpsmileindia.in/what-we-do'
	],
];