<?php 

namespace Helpsmile\Events\Donations;

use Helpsmile\Donation;
use Illuminate\Queue\SerializesModels;

class DonationWasSuccessful
{

    use SerializesModels;

    /**
     * Donation Model.
     *
     * @var \Helpsmile\Donation
     */
    public $donation;

    /**
     * Create a new DonationWasSuccessful instance.
     *
     * @param  \Helpsmile\Donation $donation
     * @return void
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }
}