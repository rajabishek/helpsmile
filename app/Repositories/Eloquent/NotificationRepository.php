<?php namespace Helpsmile\Repositories\Eloquent;

use Helpsmile\Donation;
use Helpsmile\Notification;
use Helpsmile\User;
use Helpsmile\Repositories\NotificationRepositoryInterface;
use Carbon\Carbon;

class NotificationRepository extends AbstractRepository implements NotificationRepositoryInterface{

    /**
     * Create a new DbNotificationRepository instance.
     *
     * @param  \Helpsmile\Notification  $donor
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }

    /**
     * Get all the recent notifications.
     *
     * @param  \Helpsmile\User  $user
     * @return \Helpsmile\Notification
     */
    public function getAllRecentForEmployee(User $user)
    {
        return $user->notifications()->orderBy('happened_at','desc')->get();
    }

    /**
     * Delete all records that are atleast one week old
     *
     * @return \Helpsmile\Notification
     */
    public function cleanUp()
    {
        $oneWeek = Carbon::now()->subWeek();

        $oldNotifications = $this->model->where('happened_at','<=',$oneWeek)->delete();

        return $oldNotifications;
    }

    /**
     * Mark the donation made by the new donor.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markDonationByNewDonor(Donation $donation)
    {
        $organisation = $donation->donor->organisation;

        $notification = $this->getNew();

        $notification->title = 'New Donor';
        $notification->type = 'new donor';
        $notification->description = "{$donation->donor->fullname} has promised to donate ₹ {$donation->promised_amount}";
        $notification->happened_at = $donation->created_at;
        $notification->save();

        $users = $organisation->users()
                            ->where('designation','Field Coordinator')
                            ->orWhere('designation','Manager')
                            ->lists('id');

        $users[] = $donation->teamleader->id;

        $notification->users()->sync($users);

        return $notification;
    }

    /**
     * Mark the donation made by an existing donor.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markDonationByExistingDonor(Donation $donation)
    {
        $organisation = $donation->donor->organisation;

        $notification = $this->getNew();

        $notification->title = 'New Donation';
        $notification->type = 'new donation';
        $notification->description = "{$donation->donor->fullname} has promised to donate ₹ {$donation->promised_amount}";
        $notification->happened_at = $donation->created_at;
        $notification->save();

        $users = $organisation->users()
                            ->where('designation','Field Coordinator')
                            ->orWhere('designation','Manager')
                            ->lists('id');

        $users[] = $donation->teamleader->id;

        $notification->users()->sync($users);

        return $notification;
    }

    /**
     * Mark the donation made by an existing donor.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markFieldExecutiveWasAssigned(Donation $donation)
    {
        $organisation = $donation->donor->organisation;

        $notification = $this->getNew();

        $notification->title = 'Field Executive Assigned';
        $notification->type = 'fieldexecutive assigned';
        $notification->description = "{$donation->fieldexecutive->fullname} was assigned to collect donation amount of ₹ {$donation->promised_amount} from {$donation->donor->fullname}";
        $notification->happened_at = Carbon::now();
        $notification->save();

        $users = $organisation->users()
                            ->where('designation','Field Coordinator')
                            ->orWhere('designation','Manager')
                            ->lists('id');

        $notification->users()->sync($users);

        return $notification;
    }

    /**
     * Mark the event when donor has completed his donation.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markSuccessfulDonation(Donation $donation)
    {
        $organisation = $donation->donor->organisation;

        $notification = $this->getNew();

        $notification->title = 'Succesfull Donation';
        $notification->type = 'donation successful';
        $notification->description = "{$donation->donor->fullname} has successfuly donated ₹ {$donation->donated_amount}";
        $notification->happened_at = $donation->donated_at;
        $notification->save();

        $users = $organisation->users()
                            ->where('designation','Field Coordinator')
                            ->orWhere('designation','Manager')
                            ->lists('id');

        $users[] = $donation->teamleader->id;

        $notification->users()->sync($users);

        return $notification;
    }

    /**
     * Mark the event when donor has cancelled his donation.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Notification
     */
    public function markCancelledDonation(Donation $donation)
    {
        $organisation = $donation->donor->organisation;

        $notification = $this->getNew();

        $notification->title = 'Donation Cancelled ';
        $notification->type = 'donation cancelled';
        $notification->description = "{$donation->donor->fullname} was disinterested in donating ₹ {$donation->promised_amount}";
        $notification->happened_at = $donation->cancelled_at;
        $notification->save();

        $users = $organisation->users()
                            ->where('designation','Field Coordinator')
                            ->orWhere('designation','Manager')
                            ->lists('id');

        $users[] = $donation->teamleader->id;

        $notification->users()->sync($users);

        return $notification;
    }
}
