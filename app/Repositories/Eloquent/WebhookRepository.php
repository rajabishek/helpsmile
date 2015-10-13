<?php namespace Helpsmile\Repositories\Eloquent;

use Helpsmile\Webhook;
use Helpsmile\Organisation;
use Illuminate\Foundation\Application;
use Helpsmile\Services\Forms\WebhookCreationForm;
use Helpsmile\Services\Forms\WebhookUpdateForm;
use Helpsmile\Repositories\WebhookRepositoryInterface;
use Helpsmile\Exceptions\WebhookNotFoundException;
use Queue;

class WebhookRepository extends AbstractRepository implements WebhookRepositoryInterface{

    /**
     * Create a new DbWebhookRepository instance.
     *
     * @param  \Helpsmile\Webhook  $webhook
     * @return void
     */
    public function __construct(Webhook $webhook,Application $app)
    {
        $this->model = $webhook;
        $this->app = $app;
    }

    /**
     * Get the user creation form service.
     *
     * @return \Helpsmile\Services\Forms\UserCreationForm
     */
    public function getWebhookCreationForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\WebhookCreationForm');
    }

    /**
     * Get the user update form service.
     *
     * @return \Helpsmile\Services\Forms\UserCreationForm
     */
    public function getWebhookUpdateForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\WebhookUpdateForm');
    }

    /**
     * Find all the webhooks from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Webhook[]
     */
    public function findAllForOrganisation(Organisation $organisation)
    {
        return $organisation->webhooks()
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

   /**
     * Find the webhooks with the curresponding url from the given organisation.
     *
     * @param  integer $url
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Webhook
     */
    public function findByUrlForOrganisation($url, Organisation $organisation)
    {
        $webhook = $organisation->webhooks()->where('url',$url)->first();

        if(is_null($webhook))
            throw new WebhookNotFoundException("The webhook with url as {$url} does not exist!");

        return $webhook;
    }

    /**
     * Find the webhooks with the curresponding id from the given organisation.
     *
     * @param  integer $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Webhook
     */
    public function findByIdForOrganisation(Organisation $organisation,$id)
    {
        $webhook = $organisation->webhooks()->find($id);

        if(is_null($webhook))
            throw new WebhookNotFoundException("The webhook with id as {$id} does not exist!");

        return $webhook;
    }

    /**
    /**
     * Search for all webhooks based on the given term from the given organisation.
     *     
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Webhook[]
     */
    public function searchByTermPaginatedForOrganisation($term, Organisation $organisation, $perPage = 8)
    {  
        $webhooks =  $organisation->webhooks()
                       ->where(function($query) use($term)
                       {
                            $query->where('url', 'LIKE', '%'.$term.'%')
                                  ->orderBy('created_at', 'desc'); 
                        })
                        ->paginate($perPage);
        return $webhooks;
    }

    /**
     * Create a new webhooks in the database for the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @param  array $data
     * @return \Helpsmile\Webhook
     */
    public function createForOrganisation(Organisation $organisation, array $data)
    {
        $webhook = $this->getNew();
        $webhook->url = $data['url'];

        $organisation->webhooks()->save($webhook);

        return $webhook;
    }

    /**
     * Update the webhook details.
     *
     * @param  \Helpsmile\Webhook $webhook
     * @param  array $data
     * @return \Helpsmile\Webhook
     */
    public function edit(Webhook $webhook, array $data)
    {   
        $webhook->url = $data['url'];
        $webhook->save();

        return $webhook;
    }
}
