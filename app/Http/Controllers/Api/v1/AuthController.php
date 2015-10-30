<?php 

namespace Helpsmile\Http\Controllers\Api\v1;

use Auth;
use JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Services\Response\CanRespondInJson;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Repositories\OrganisationRepositoryInterface;
use Helpsmile\Transformers\UserTransformer;
use Helpsmile\Services\Forms\LoginForm;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Exceptions\EmployeeNotFoundException;
use Helpsmile\Exceptions\OrganisationNotFoundException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller{

	/**
     * Trait to handle responding in JSON with proper status codes.
     *
     * @see \Helpsmile\Services\Response\CanRespondInJson
     */
    use CanRespondInJson;

    /**
	 * User Repository.
	 * 
	 * @var \Helpsmile\Repositories\UserRepositoryInterface
	 */
	protected $users;

	/**
	 * Organisation Repository.
	 * 
	 * @var \Helpsmile\Repositories\OrganisationRepositoryInterface
	 */
	protected $organisations;

	/**
     * The user transformer to transform the user data
     * 
     * @var \Helpsmile\Transformers\UserTransformer
     */
    protected $userTransformer;

	/**
	 * Create a new AuthController instance and inject the dependencies
	 * 
	 * @param \Helpsmile\Repositories\UserRepositoryInterface $users
	 * @return void
	 */
	public function __construct(UserRepositoryInterface $users,
		OrganisationRepositoryInterface $organisations,
		UserTransformer $userTransformer){
		
		$this->users = $users;
		$this->organisations = $organisations;
		$this->userTransformer = $userTransformer;
	}

	/**
	 * Check whether the user with the given email address is eligible to use web app.
	 *
	 * @return string
	 */
	protected function checkEligibilityForLoginFromDomain($email,$domain)
	{
		try
		{
			$organisation = $this->organisations->findByDomain($domain);
			$employee = $this->users->findByEmailForOrganisation($email,$organisation);
			
			if($employee->hasRole('Admin') 
				|| $employee->hasRole('Team Leader') 
				|| $employee->hasRole('Field Coordinator') 
				|| $employee->hasRole('Manager'))
			{
				return false;
			}

			return true;
		}
		catch(EmployeeNotFoundException $e)
		{
			return false;
		}
		catch(OrganisationNotFoundException $e)
		{
			return false;
		}
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin($domain, LoginForm $form, Request $request)
	{
		try
		{	
			$credentials = $request->only(['email', 'password']);
			$form->validate($credentials);
			
			if(!$this->checkEligibilityForLoginFromDomain($credentials['email'],$domain))
				return $this->respondUnauthorizedRequest("You don't have permissions to use the application.");

            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials))
            	return $this->respondUnauthorizedRequest($this->getFailedLoginMessage());
	        
	        // if no errors are encountered we can return the generated JWT
      		$user = JWTAuth::toUser($token);
    
      		if(! $user->hasRole('Field Executive'))
      			return $this->respondForbidden();
        	
        	return response()->json([
        		'success' => true, 
        		'token' => $token, 
        		'data' => $this->userTransformer->transform($user->toArray())
        	]);
				
		}
		catch(FormValidationException $e)
	    {
	    	return $this->respondBadRequest($e->getErrors()->all());
	    }
	    catch(JWTException $e) 
	    {
	    	return $this->respondInternalError('Sorry could not create a token for you.');
	    }
	    catch(Exception $e)
	    {
	    	//Fall back if nothing works 
		    return $this->respondInternalError();
	    }
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'Invalid credentials.';
	}
}
