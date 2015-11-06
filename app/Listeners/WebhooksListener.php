<?php 

namespace Helpsmile\Listeners;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Helpsmile\Repositories\WebhookRepositoryInterface;
use Helpsmile\Events\Donors\NewDonorHasAgreedToContribute;
use Helpsmile\Events\Donors\ExistingDonorHasAgreedToContribute;
use Helpsmile\Events\Donations\FieldExecutiveWasAssignedForDonation;
use Helpsmile\Events\Donations\DonationWasSuccessful;
use Helpsmile\Events\Donations\DonationWasCancelled;
use Helpsmile\Jobs\HitEndpoint;
use Helpsmile\Organisation;

class WebhooksListener extends EventListener 
{

    /**
     * Trait to help push jobs on the queue
     *
     * @var \Illuminate\Foundation\Bus\DispatchesJobs
     */
    use DispatchesJobs;

    /**
     * Webhook Repository
     *
     * @var \Helpsmile\Repositories\WebhookRepositoryInterface
     */
    protected $webhooks;

    /**
     * Create a new WebhooksListener instance.
     *
     * @param \Helpsmile\Repositories\WebhookRepositoryInterface $webhooks
     * @return void
     */
    public function __construct(WebhookRepositoryInterface $webhooks)
    {
        $this->webhooks = $webhooks; 
    }

    /**
     * Hits the webhook endpoints with the object data for the given $event.
     *
     * @param \Helpsmile\Organisation $organisation
     * @param Object $organisation
     * @param string $event
     * @return null
     */
    protected function hitWebhookEndpointsOfOrganisationUsingObjectForEvent(Organisation $organisation,$object,$event)
    {
        $webhooks = $this->webhooks->findAllForOrganisation($organisation);
        if($webhooks->count() > 0)
        {
            foreach ($webhooks as $webhook) 
            {
                $data = ['url' => $webhook->url,'object' => $object->toArray(), 'event' => $event];
                
                $job = (new HitEndpoint($data))->onQueue('emails');
                $this->dispatch($job);
            }
        }
    }

    /**
	 * Notify the manager when a new donor has promised to make a contribution.
	 * 
	 * @return void
	 */
	public function whenNewDonorHasAgreedToContribute(NewDonorHasAgreedToContribute $event)
    {
        $donation = $event->donation;
        $organisation = $donation->donor->organisation;
        $this->hitWebhookEndpointsOfOrganisationUsingObjectForEvent($organisation,$donation->donor,'donor.created');
    }

    /**
     * Notify the manager when an existing donor has promised to make a contribution.
     * 
     * @return void
     */
    public function whenExistingDonorHasAgreedToContribute(ExistingDonorHasAgreedToContribute $event)
    {
        $donation = $event->donation;
        $organisation = $donation->donor->organisation;
        $this->hitWebhookEndpointsOfOrganisationUsingObjectForEvent($organisation,$donation,'donation.created');
    }

    /**
     * Notify the manager when a fieldexecutive is assigned to collect donation from the donor.
     * 
     * @return void
     */
    public function whenFieldExecutiveWasAssignedForDonation(FieldExecutiveWasAssignedForDonation $event)
    {
        $donation = $event->donation;
        $organisation = $donation->donor->organisation;
        $this->hitWebhookEndpointsOfOrganisationUsingObjectForEvent($organisation,$donation,'donation.assigned');
    }

    /**
     * Notify the manager when the donor has successfuly contributed.
     * 
     * @return void
     */
    public function whenDonationWasSuccessful(DonationWasSuccessful $event)
    {
        $donation = $event->donation;
        $organisation = $donation->donor->organisation;
        $this->hitWebhookEndpointsOfOrganisationUsingObjectForEvent($organisation,$donation,'donation.successful');
    }

    /**
     * Notify the manager when the donor cancelled his donation.
     * 
     * @return void
     */
    public function whenDonationWasCancelled(DonationWasCancelled $event)
    {
         $donation = $event->donation;
        $organisation = $donation->donor->organisation;
        $this->hitWebhookEndpointsOfOrganisationUsingObjectForEvent($organisation,$donation,'donation.cancelled');
    }
}
