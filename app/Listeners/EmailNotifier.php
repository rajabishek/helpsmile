<?php 

namespace Helpsmile\Listeners;

use Helpsmile\Events\Donations\DonationWasSuccessful;
use Helpsmile\Mailers\DonorMailer;

class EmailNotifier extends EventListener
{

    /**
     * Send a thankyou email for the donor for this contribution
     * 
     * @return void
     */
    public function whenDonationWasSuccessful(DonationWasSuccessful $event)
    {
        $donation = $event->donation;

        return (new DonorMailer($donation))->thankyou()->deliver();
    }
}
