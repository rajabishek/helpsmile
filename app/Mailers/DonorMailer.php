<?php namespace Helpsmile\Mailers;

use Helpsmile\Exceptions\InvalidContactInformationException;
use Mail;
use Helpsmile\Models\Donation;

class DonorMailer extends Mailer
{
    /**
     * Create a new DonorMailer instance.
     *
     * @param \Helpsmile\Models\Donation $donation
     */
    public function __construct(Donation $donation)
    {
        if(!is_object($donation->donor)){
            throw new InvalidContactInformationException("A valid donor object must be provided for delivering an email !");
        }

        $this->to = $donation->donor->fullname;
        $this->email = $donation->donor->email;
        $this->data = $donation->toArray();
    }

    /**
     * The method that delivers a welcome email
     *
     * @return \Helpsmile\Mailer\DonorMailer
     */
    public function thankyou()
    {
        $this->subject = 'Thank you for the donation';
        $this->view = 'emails.donors.thankyou';

        return $this;
    }
}