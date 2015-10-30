<?php 

namespace Helpsmile\Events\Donors;

use Helpsmile\Donor;
use Helpsmile\Donation;
use Illuminate\Queue\SerializesModels;

class ExistingDonorHasAgreedToContribute
{

    use SerializesModels;
    
    /**
     * Donor model.
     *
     * @var \Helpsmile\Donor
     */
    public $donor;

    /**
     * Donation Model.
     *
     * @var \Helpsmile\Donation
     */
    public $donation;

    /**
     * Create a new NewDonorHasAgreedToContribute instance.
     *
     * @param  \Helpsmile\Donor $donor
     * @param  \Helpsmile\Donation $donation
     * @return void
     */
    public function __construct(Donor $donor, Donation $donation)
    {
        $this->donor = $donor;
        $this->donation = $donation;
    }
}