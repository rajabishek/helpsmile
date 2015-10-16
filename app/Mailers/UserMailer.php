<?php namespace Helpsmile\Mailers;

use Helpsmile\Exceptions\InvalidContactInformationException;
use Mail;
use Helpsmile\User;
use Subscription;

class UserMailer extends Mailer
{
    /**
     * Create a new abstract mailer instance.
     *
     * @param \Helpsmile\User $user
     */
    public function __construct(User $user)
    {
        if(!is_object($user)){
            throw new InvalidContactInformationException("A valid user object must be provided for delivering an email !");
        }

        $this->to = $user->fullname;
        $this->email = $user->email;
        $this->organisation = $user->organisation;
        $this->data = $user->toArray();
        $this->data['organisation'] = $this->organisation->toArray();
    }

    /**
     * The method that delivers a welcome email
     *
     * @return \Helpsmile\Mailer\UserMailer
     */
    public function welcome()
    {
        $this->subject = 'Welcome to Helpsmile';
        $this->view = 'emails.users.welcome';

        return $this;
    }

    /**
     * Notif the user after the password has changed for him
     *
     * @return \Helpsmile\Mailer\UserMailer
     */
    public function passwordChanged()
    {
        $this->subject = 'Password Changed';
        $this->view = 'emails.users.passwordChanged';

        return $this;
    }

    /**
     * The method that delivers account verification link to registered user
     *
     * @return \Paywall\Mailer\UserMailer
     */
    public function emailVerification()
    {
        $this->subject = 'Confirm your Helpsmile Account';
        $this->view = 'emails.users.emailVerification';

        return $this;
    }
}