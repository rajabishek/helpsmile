<?php

namespace Helpsmile\Http\Controllers\Auth;

use Helpsmile\User;
use Validator;
use Helpsmile\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laracasts\Flash\FlashNotifier;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Repositories\OrganisationRepositoryInterface;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Exceptions\EmployeeNotFoundException;
use Helpsmile\Exceptions\OrganisationNotFoundException;
use Helpsmile\Exceptions\InvalidConfirmationCodeException;
use Helpsmile\Mailers\UserMailer;

class AuthController extends Controller
{
    /**
     * The flash notifier.
     *
     * @var \Laracasts\Flash\FlashNotifier
     */
    protected $flash;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(FlashNotifier $flash)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->flash = $flash;
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
        $organisation = app(OrganisationRepositoryInterface::class)->create($data);
        
  
        $data['designation'] = 'Admin';      
        $user = $this->users->createForOrganisation($data,$organisation);

        //Email the user
        $mailer = new UserMailer($user);
        return $mailer->emailVerification()->queue()->deliver(); 
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request, OrganiationRegistrationForm $form)
    {
        $input = $request->all();

        try
        {
            $form->validate($input);
            $this->registerOrganisation($input);

            $this->flash->success('Thanks for registering your company with us! Please check your email.');
            return redirect()->back();
        }
        catch(FormValidationException $e)
        {
            $this->flash->error('Please review the following errors.');
            return redirect()->back()>withInput()->withErrors($e->getErrors());
        }
    }
}
