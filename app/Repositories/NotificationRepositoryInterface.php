<?php namespace Helpsmile\Repositories;

use Helpsmile\Donation;
use Helpsmile\User;

interface NotificationRepositoryInterface
{
    /**
     * Get all the recent notifications.
     *
     * @param  \Helpsmile\User  $user
     * @return \Helpsmile\Notification
     */
    public function getAllRecentForEmployee(User $user);

    /**
     * Mark the donation made by the new donor.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markDonationByNewDonor(Donation $donation);

    /**
     * Mark the donation made by an existing donor.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markDonationByExistingDonor(Donation $donation);

    /**
     * Mark the donation made by an existing donor.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markFieldExecutiveWasAssigned(Donation $donation);

    /**
     * Mark the event when donor has completed his donation.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markSuccessfulDonation(Donation $donation);

    /**
     * Mark the event when donor has cancelled his donation.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markCancelledDonation(Donation $donation);
}