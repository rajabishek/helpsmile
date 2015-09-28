<?php

use Illuminate\Database\Seeder;
use Helpsmile\User;
use Helpsmile\Organisation;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisation = Organisation::first();
        $password = bcrypt('password');

        $user = factory(User::class)
			    	->make([
							'email' => 'rajabishek@hotmail.com',
							'password' => $password,
							'fullname' => 'Administrator',
							'address' => 'Sample address',
							'mobile' => '9840944730',
							'designation' => 'Admin',
					]);
		$organisation->users()->save($user);

		$user = factory(User::class)
			    	->make([
						'email' => 'rajabishek@sightsaversindia.in',
						'password' => $password,
						'fullname' => 'Raj Abishek',
						'address' => 'NGO Colony,Adambakkam',
						'mobile' => '9988776655',
						'designation' => 'Team Leader',
						'organisation_id' => $organisation->id
					]);
		$organisation->users()->save($user);

		$user = factory(User::class)
			    	->make([
						'email' => 'saileshdev@sightsaversindia.in',
						'password' => $password,
						'fullname' => 'Sailesh Dev',
						'address' => 'NGO Colony, Chennai-600088',
						'mobile' => '9943598435',
						'designation' => 'Telecaller',
						'organisation_id' => $organisation->id
					]);
		$organisation->users()->save($user);

		$user = factory(User::class)
			    	->make([
					'email' => 'devaprakash@sightsaversindia.in',
					'password' => $password,
					'fullname' => 'Devaprakash',
					'address' => 'NGO Colony, Chennai-600088',
					'mobile' => '9840944730',
					'designation' => 'Field Coordinator',
					'organisation_id' => $organisation->id
				]);
		$organisation->users()->save($user);

		$user = factory(User::class)
			    	->make([
					'email' => 'kaniamuthu@sightsaversindia.in',
					'password' => $password,
					'fullname' => 'Kaniamuthu',
					'address' => 'NGO Colony, Chennai-600088',
					'mobile' => '9840944678',
					'designation' => 'Field Executive',
					'organisation_id' => $organisation->id
				]);
		$organisation->users()->save($user);

		$user = factory(User::class)
			    	->make([
					'email' => 'pragadeeswaran@sightsaversindia.in',
					'password' => $password,
					'fullname' => 'Pragadeeswaran',
					'address' => 'NGO Colony, Chennai-600088',
					'mobile' => '9443001085',
					'designation' => 'Manager',
					'organisation_id' => $organisation->id
				]);
		$organisation->users()->save($user);

		$users = factory(User::class, 100)
			    	->make(['password' => $password])
			    	->each(function($user) use($organisation){
			        	$organisation->users()->save($user);
			        });
    }
}
