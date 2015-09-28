<?php

use Illuminate\Database\Seeder;
use Helpsmile\Organisation;
use Helpsmile\User;
use Helpsmile\Donor;
use Helpsmile\Donation;
use Helpsmile\Address;

class DonorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisation = Organisation::first();
		$teamleader = User::where('email','rajabishek@sightsaversindia.in')->first();
		$executive = User::where('email','kaniamuthu@sightsaversindia.in')->first();

		$telecallerids = User::where('designation','Telecaller')->lists('id');
		$max = sizeof($telecallerids) - 1;

		foreach(range(1, 20) as $index)
		{
	        $donor = $organisation->donors()->save(factory(Donor::class)->make());

	        $donation = factory(Donation::class)->make();
	        $donation->donor()->associate($donor);
	        $donation->telecaller_id = $telecallerids[rand(0,$max)];
	        $donation = $teamleader->uploadedDonations()->save($donation);

	        $donation->address()->save(factory(Address::class)->make());
		}
    }
}
