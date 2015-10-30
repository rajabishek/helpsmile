<?php

namespace Helpsmile\Http\Controllers\Auth;

use Auth;
use Validator;
use Helpsmile\User;
use Helpsmile\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Helpsmile\Repositories\OrganisationRepositoryInterface;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Services\Forms\LoginForm;
use Helpsmile\Services\Forms\RegistrationForm;
use Helpsmile\Services\Forms\ResendEmailVerificationForm;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Exceptions\EmployeeNotFoundException;
use Helpsmile\Exceptions\OrganisationNotFoundException;
use Helpsmile\Exceptions\InvalidConfirmationCodeException;
use Helpsmile\Mailers\UserMailer;

class AuthController extends Controller
{
    /**
     * Organisation Repository.
     * 
     * @var \Helpsmile\Repositories\OrganisationRepositoryInterface
     */
    protected $organisations;

    /**
     * User Repository.
     * 
     * @var \Helpsmile\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(OrganisationRepositoryInterface $organisations, 
        UserRepositoryInterface $users)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->organisations = $organisations;
        $this->users = $users;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('pages.register');
    }

    /**
     * Register the given organisation.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    protected function registerOrganisation($data)
    {
        $data['confirmation_code'] = str_random(30);
        $organisation = $this->organisations->create($data);
        
  
        $data['designation'] = 'Admin';      
        $user = $this->users->createForOrganisation($data,$organisation);

        //Email the user
        $mailer = new UserMailer($user);
        //return $mailer->emailVerification()->queue()->deliver(); 
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(RegistrationForm $form, Request $request)
    {
        try
        {
            $this->registerOrganisation($request->all());

            flash()->success('Thanks for registering your company with us! Please check your email.');
            return redirect()->back();
        }
        catch(FormValidationException $e)
        {
            flash()->error('Please review the following errors.');
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin($domain)
    {
        $organisation = $this->organisations->findByDomain($domain);
        return view('pages.login',compact('domain','organisation'));
    }

    /**
     * Handle a login request to the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin($domain, LoginForm $form, Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        try
        {
            $form->validate($credentials);
            if(!$this->checkEligibilityForLoginFromDomain($credentials['email'],$domain))
            {
                $message = "You don't have permissions to use the application.";

                if($request->ajax())
                    return response()->json(['success' => false,'errors' => $message]);

                flash()->error($message);
                    return redirect()->back();
            }

            if (Auth::attempt($credentials, $request->has('remember')))
            {
                $redirectPath = route(Auth::user()->getHomeRoute(),$domain);
                
                if($request->ajax())
                    return response()->json(['success' => true,'redirect' => $redirectPath]);

                return redirect()->intended($redirectPath,$domain);
            }

            if($request->ajax())
                return response()->json(['success' => false,'errors' => $this->getFailedLoginMessage()]);

            flash()->error($this->getFailedLoginMessage());
            return redirect()->back();

        }
        catch(FormValidationException $e)
        {
            if($request->ajax())
                return response()->json(['success' => false,'errors' => $e->getErrors()->all()]);
            
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Check whether the user with the given email address is eligible to use web app.
     *
     * @return boolean
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
                return true;
            }

            return false;
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
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'Invalid credentials.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout($domain)
    {
        Auth::logout();
        
        flash()->success('You have been successfully logged out.');
        return redirect()->route('auth.getLogin',$domain);
    }

    /**
     * Present a form for resending the account verification email to the admin of the organisation.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResend()
    {
        return view('pages.resend');
    }

    /**
     * Resend the account verification email to the admin of the organisation.
     *
     * @return \Illuminate\Http\Response
     */
    public function postResend(ResendEmailVerificationForm $form, Request $request)
    {
        try
        {
            $input = $request->all();
            $form->validate($input);
            $organisation = $this->organisations->findByDomain($input['domain']);
            $user = $this->users->findByEmailForOrganisation($input['email'], $organisation);

            if($organisation->confirmed)
            {
                flash()->success("{$organisation->name}'s account is already verified, you may log in here.");
                return redirect()->route('auth.getLogin',$organisation->domain);
            }

            if($user->hasRole('Admin'))
            {
                //Email the user
                $mailer = new UserMailer($user);
                $mailer->emailVerification()->queue()->deliver(); 
                flash()->success('The verification email has been resent. Please check your email.');
                return redirect()->back();
            }
            else 
                throw new EmployeeNotFoundException;

        }
        catch(OrganisationNotFoundException $e)
        {
            flash()->error('The provided domain does not exist.');
            return redirect()->back()->withInput();
        }
        catch(EmployeeNotFoundException $e)
        {
            flash()->error("The provided email address is not the same as {$organisation->name}'s admin.");
            return redirect()->back()->withInput();
        }
        catch(FormValidationException $e)
        {
           return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }
}
