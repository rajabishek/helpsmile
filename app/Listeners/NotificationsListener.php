<?php 

namespace Helpsmile\Listeners;

use Helpsmile\Repositories\NotificationRepositoryInterface;
use Helpsmile\Events\Donors\NewDonorHasAgreedToContribute;
use Helpsmile\Events\Donors\ExistingDonorHasAgreedToContribute;
use Helpsmile\Events\Donations\FieldExecutiveWasAssignedForDonation;
use Helpsmile\Events\Donations\DonationWasSuccessful;
use Helpsmile\Events\Donations\DonationWasCancelled;

class NotificationsListener extends EventListener 
{

    /**
     * Notification repository.
     *
     * @var \Helpsmile\Repositories\NotificationRepositoryInterface
     */
    protected $notifications;

    /**
     * Create a new NotificationsListener instance.
     *
     * @param  \Helpsmile\Repositories\NotificationRepositoryInterface $notifications
     * @return void
     */
    public function __construct(NotificationRepositoryInterface $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
	 * Notify the manager when a new donor has promised to make a contribution.
	 * 
	 * @return void
	 */
	public function whenNewDonorHasAgreedToContribute(NewDonorHasAgreedToContribute $event)
    {
        $donation = $event->donation;
        $this->notifications->markDonationByNewDonor($donation);
    }

    /**
     * Notify the manager when an existing donor has promised to make a contribution.
     * 
     * @return void
     */
    public function whenExistingDonorHasAgreedToContribute(ExistingDonorHasAgreedToContribute $event)
    {
        $donation = $event->donation;
        $this->notifications->markDonationByExistingDonor($donation);
    }

    /**
     * Notify the manager when a fieldexecutive is assigned to collect donation from the donor.
     * 
     * @return void
     */
    public function whenFieldExecutiveWasAssignedForDonation(FieldExecutiveWasAssignedForDonation $event)
    {
        $donation = $event->donation;
        $this->notifications->markFieldExecutiveWasAssigned($donation);
    }

    /**
     * Notify the manager when the donor has successfuly contributed.
     * 
     * @return void
     */
    public function whenDonationWasSuccessful(DonationWasSuccessful $event)
    {
        $donation = $event->donation;
        $this->notifications->markSuccessfulDonation($donation);
    }

    /**
     * Notify the manager when the donor cancelled his donation.
     * 
     * @return void
     */
    public function whenDonationWasCancelled(DonationWasCancelled $event)
    {
        $donation = $event->donation;
        $this->notifications->markCancelledDonation($donation);
    }
}
