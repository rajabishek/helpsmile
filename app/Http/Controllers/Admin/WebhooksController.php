<?php 

namespace Helpsmile\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Repositories\WebhookRepositoryInterface;
use Helpsmile\Services\Forms\WebhookCreationForm;
use Helpsmile\Services\Forms\WebhookUpdateForm;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Transformers\WebhookTransformer;
use Helpsmile\Exceptions\WebhookNotFoundException;

class WebhooksController extends Controller{

    /**
     * Webhook repository.
     *
     * @var \Helpsmile\Repositories\WebhookRepositoryInterface
     */
    protected $webhooks;

    /**
     * Create a new UsersController instance.
     *
     * @param  \Helpsmile\Repositories\WebhookRepositoryInterface $webhooks
     * @return void
     */
    public function __construct(WebhookRepositoryInterface $webhooks)
    {
        $this->webhooks = $webhooks;
    }

    /**
     * Show the users index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($domain)
    {
        $webhooks = $this->webhooks->findAllForOrganisation(Auth::user()->organisation);
        return view('admin.webhooks.index', compact('domain','webhooks'));
    }

    /**
     * Get the webhooks created by the admin in JSON.
     *
     * @param  string $domain
     * @param  \Helpsmile\Transformers\WebhookTransformer $webhookTransformer
     * @return \Illuminate\Http\Response
     */
    public function getWebhooks($domain, WebhookTransformer $webhookTransformer)
    {
        $webhooks = $this->webhooks->findAllForOrganisation(Auth::user()->organisation);                   
            
        return response()->json([
            'success' => true,
            'data' => $webhookTransformer->transformCollection($webhooks->toArray())
        ]);
    }

    /**
     * Handle the creation of a new user.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($domain, WebhookCreationForm $form, Request $request)
    {
        try
        {
            $input = $request->all();
            $form->validate($input);
            $webhook = $this->webhooks->createForOrganisation(Auth::user()->organisation,$input);

            return response()->json(['success' => true]);    
        }
        catch(FormValidationException $e)
        {
            return response()->json(['success' => false,'errors' => $e->getErrors()->all()]);
        }
    }

    /**
     * Update the user with the new data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($domain, $id, WebhookUpdateForm $form, Request $request)
    {
        
        $input = $request->all();
        $input['id'] = $id;

        try
        {
            $form->validate($input);
            $webhook = $this->webhooks->findByIdForOrganisation(Auth::user()->organisation,$id);
            $webhook = $this->webhooks->edit($webhook,$input);
            
            return response()->json(['success' => true]);    
        }
        catch(WebhookNotFoundException $e)
        {
            return response()->json(['success' => false,'errors' => "You either don't have permissions to change this webhook or the webhook you tried to update does not exist anymore."]);
        }
        catch(FormValidationException $e)
        {
            return response()->json(['success' => false,'errors' => $e->getErrors()->all()]);
        }
    }

    /**
     * Handle the process of destroying an existing user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($domain, $id)
    {    
        try 
        {
            $webhook = $this->webhooks->findByIdForOrganisation(Auth::user()->organisation,$id);
            $webhook->delete();

            return response()->json(['success' => true]);        
        }
        catch(WebhookNotFoundException $e)
        {
            return response()->json(['success' => false,'errors' => "You either don't have permissions to remove this webhook or the webhook you tried to delete does not exist anymore."]);
        }
    }
}
