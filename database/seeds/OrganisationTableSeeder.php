<?php

use Illuminate\Database\Seeder;
use Helpsmile\Organisation;

class OrganisationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(Helpsmile\Organisation::class)->create([
        	'name' => 'Sightsavers',
        	'domain' => 'sightsavers'
        ]);
    }
}
