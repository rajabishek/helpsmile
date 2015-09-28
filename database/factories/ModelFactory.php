<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Helpsmile\Organisation::class, function (Faker\Generator $faker) {
    
    $company = ucwords($faker->company);
    
    return [
		'name' => $company,
		'domain' => str_slug($company,'-')
	];
});

$factory->define(Helpsmile\User::class, function (Faker\Generator $faker) {
    
    $designations = ['Telecaller','Team Leader','Field Executive','Field Coordinator','Manager'];
	$max = sizeof($designations) - 1;
	$designation = $designations[$faker->numberBetween(0,$max)];

    return [
		'email' => $faker->safeEmail,
		'password' => bcrypt(str_random(10)),
		'fullname' => $faker->name,
		'address' => $faker->address,
		'mobile' => $faker->phoneNumber,
		'designation' => $designation,
		'remember_token' => str_random(10),
	];
});

$factory->define(Helpsmile\Donor::class, function (Faker\Generator $faker) {
    return [
		'email' => $faker->safeEmail,
		'fullname' => $faker->name,
		'mobile' => $faker->phoneNumber,
	];
});

$factory->define(Helpsmile\Donation::class, function (Faker\Generator $faker) {
    return [
		'promised_amount' => $faker->randomNumber(4),
		'appointment' => $faker->dateTime('now'),
		'created_at' => $faker->dateTimeThisYear,
	];
});

$factory->define(Helpsmile\Address::class, function (Faker\Generator $faker) {
    return [
		'address' => $faker->streetAddress,
		'location' => $faker->streetName,
		'latitude' => $faker->latitude,
		'longitude' => $faker->longitude,
	];
});
