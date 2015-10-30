<?php 

namespace Helpsmile\Events\Donations;

use Helpsmile\Donation;
use Illuminate\Queue\SerializesModels;

class DonationWasCancelled
{

    use SerializesModels;

    /**
     * Donation Model.
     *
     * @var \Helpsmile\Donation
     */
    public $donation;

    /**
     * Create a new DonationWasCancelled instance.
     *
     * @param  \Helpsmile\Donation $donation
     * @return void
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }
}