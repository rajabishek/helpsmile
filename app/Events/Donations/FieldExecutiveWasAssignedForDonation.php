<?php 

namespace Helpsmile\Events\Donations;

use Helpsmile\Donation;
use Illuminate\Queue\SerializesModels;

class FieldExecutiveWasAssignedForDonation
{

    use SerializesModels;

    /**
     * Donation Model.
     *
     * @var \Helpsmile\Donation
     */
    public $donation;

    /**
     * Create a new FieldExecutiveWasAssignedForDonation instance.
     *
     * @param  \Helpsmile\Donation $donation
     * @return void
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }
}