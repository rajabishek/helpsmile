<?php 

namespace Helpsmile\Http\Controllers\Api\v1\Fieldexecutive;

use Auth;
use JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Services\Response\CanRespondInJson;
use Helpsmile\Repositories\DonationRepositoryInterface;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Repositories\OrganisationRepositoryInterface;
use Helpsmile\Exceptions\OrganisationNotFoundException;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Transformers\DonationTransformer;
use Helpsmile\Exceptions\DonationNotFoundException;

class DonationsController extends Controller{

    /**
     * Trait to handle responding in JSON with proper status codes.
     *
     * @see \Helpsmile\Services\Response\CanRespondInJson
     */
    use CanRespondInJson;

    /**
     * Donor repository.
     *
     * @var \Helpsmile\Repositories\DonationRepositoryInterface
     */
    protected $donations;

    /**
     * User repository.
     *
     * @var \Helpsmile\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * The donor user object obtained from JWT
     *
     * @var \Helpsmile\Models\User
     */
    protected $user;

    /**
     * The donor transformer to transform the donor data
     * 
     * @var \Helpsmile\Transformers\DonationTransformer
     */
    protected $donationTransformer;

    /**
     * Create a new DonationsController instance.
     *
     * @param  \Helpsmile\Repositories\DonationRepositoryInterface $donations
     * @param  \Helpsmile\Repositories\UserRepositoryInterface $users
     * @param  \Helpsmile\Transformers\DonationTransformer $donationTransformer
     * @return void
     */
    public function __construct(DonationRepositoryInterface $donations, 
        UserRepositoryInterface $users,
        DonationTransformer $donationTransformer){

		$this->middleware('jwt.auth',['only' => ['index','show','update']]);

        $this->donations = $donations;
        $this->users = $users;
        $this->donationTransformer = $donationTransformer;
    }

    /**
     * Get the authenticated user curresponding to the given JWT
     *
     * @return  \Helpsmile\Models\User $user
     */
	protected function getAuthenticatedUser()
	{
        //We dont catch any throw exceptions, as wherever this method is called jwt.auth filter is 
        //called prior to it that catches and handles the appopriate exceptions
	    return JWTAuth::parseToken()->toUser();
	}

    /**
	 * Get all the pending donations assigned for the given field executive.
	 * GET /fieldexecutives/{fieldexecutiveId}/donations
	 *
	 * @return Response
	 */
	public function index($domain, $fieldexecutiveId){

        try
        {
            $executive = $this->getAuthenticatedUser();
        
            if($fieldexecutiveId != $executive->id)
                return $this->respondForbidden();

            $donations = $this->donations
                              ->findAllPendingAssignedForFieldExecutive($executive)
                              ->getCollection();
            
            return response()->json([
                'success' => true,
                'data' => $this->donationTransformer->transformCollection($donations->toArray())
            ]);
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
	}

    /**
     * Get the given pending donation assigned for the given field executive.
     * GET /fieldexecutives/{fieldexecutiveId}/donation/{donationId}
     *
     * @return Response
     */
    public function show($domain, $fieldexecutiveId, $donationId){

        try
        {
            $executive = $this->getAuthenticatedUser();
        
            if($fieldexecutiveId != $executive->id)
                return $this->respondForbidden();

            $donation = $this->donations->findByIdAssignedForFieldExecutive($donationId,$executive);
            
            return response()->json([
                'success' => true,
                'data' => $this->donationTransformer->transform($donation->toArray())
            ]);
        }
        catch(DonationNotFoundException $e){
            return $this->respondNotFound($e->getMessage());
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }

    /**
     * Update the given pending donation for the given field executive.
     * PUT /fieldexecutives/{fieldexecutiveId}/donations/{donationId}
     *
     * @return Response
     */
    public function update($domain, $fieldexecutiveId, $donationId, Request $request){

        try
        {
            $executive = $this->getAuthenticatedUser();
        
            if($fieldexecutiveId != $executive->id)
                return $this->respondForbidden();

            $input = $request->only('status','donated_amount');
            
            $form = $this->donations->getDonationCompletionForm();
            $form->validate($input);

            if($input['status'] == 'donated')
            {
                $donation = $this->donations->findByIdAssignedForFieldExecutive($donationId,$executive);
                
                $donation = $this->donations->markAsDonated($donation,$input['donated_amount']);
                
                return response()->json([
                    'success' => true,
                    'data' => $this->donationTransformer->transform($donation->toArray())
                ]);
            }
            else if($input['status'] == 'disinterested')
            {
                $donation = $this->donations->findByIdAssignedForFieldExecutive($donationId,$executive);
                $donation = $this->donations->markAsDisinterested($donation);
                
                return response()->json([
                    'success' => true,
                    'data' => $this->donationTransformer->transform($donation->toArray())
                ]);
            }
            else
            {
                return $this->respondInternalError();
            }
        }
        catch(FormValidationException $e)
        {
            return $this->respondBadRequest($e->getErrors()->all());
        }
        catch(DonationNotFoundException $e){
            return $this->respondNotFound($e->getMessage());
        }
        
    }
}
