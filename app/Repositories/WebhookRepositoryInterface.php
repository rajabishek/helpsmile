<?php namespace Helpsmile\Repositories;

use Helpsmile\User;
use Helpsmile\Webhook;
use Helpsmile\Organisation;

interface WebhookRepositoryInterface
{
    /**
     * Get the webhook creation form service.
     * 
     * @return \Helpsmile\Services\Forms\WebhookCreationForm
     */
    public function getWebhookCreationForm();

    /**
     * Find all the webhooks from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Webhook[]
     */
    public function findAllForOrganisation(Organisation $organisation);

    /**
     * Search for all webhooks based on the given term from the given organisation.
     *     
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Webhook[]
     */
    public function searchByTermPaginatedForOrganisation($term, Organisation $organisation, $perPage = 8);

    /**
     * Create a new webhooks in the database for the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @param  array $data
     * @return \Helpsmile\Webhook
     */
    public function createForOrganisation(Organisation $organisation, array $data);

    /**
     * Update the webhook details.
     *
     * @param  \Helpsmile\Webhook $webhook
     * @param  array $data
     * @return \Helpsmile\Webhook
     */
    public function edit(Webhook $webhook, array $data);

    /**
     * Find the webhooks with the curresponding url from the given organisation.
     *
     * @param  integer $url
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Webhook
     */
    public function findByUrlForOrganisation($url, Organisation $organisation);

    /**
     * Find the webhooks with the curresponding id from the given organisation.
     *
     * @param  integer $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Webhook
     */
    public function findByIdForOrganisation(Organisation $organisation,$id);
}
