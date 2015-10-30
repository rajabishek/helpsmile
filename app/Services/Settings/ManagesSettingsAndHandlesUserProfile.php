<?php namespace Helpsmile\Services\Settings;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;
use Laracasts\Flash\Flash;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Services\Upload\ImageUploadService;
use Helpsmile\Services\Forms\ChangePasswordForm;

trait ManagesSettingsAndHandlesUserProfile{

    /**
     * User repository.
     *
     * @var \Helpsmile\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new PublisherSettingsController instance.
     *
     * @param  \Helpsmile\Repositories\UserRepositoryInterface  $users 
     * @return void
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

	/**
	 * Display a listing of the resource.
	 * GET /teamleader/settings
	 *
	 * @return Response
	 */
	public function index($domain, Request $request)
	{
		$user = $request->user();
		return view($this->settingsView,compact('domain','user'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /teamleader/settings
	 *
	 * @return Response
	 */
	public function store($domain, Request $request)
	{
		try
        {
            $input = $request->all();
            $user = $request->user();
            $input['id'] = $user->id;
            $this->users->getSettingsForm()->validate($input);
            
            $this->users->edit($user,$request->all());  

            flash()->success('You have succesfully saved the details.');
            return redirect()->route($this->settingsRoute,$domain);
        }
        catch(FormValidationException $e)
        {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
	}

    /**
     * Store a newly created resource in storage.
     * POST /teamleader/settings
     *
     * @param  string $domain
     * @param  \Helpsmile\Services\Upload\ImageUploadService  $uploader
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function changeProfile($domain, ImageUploadService $uploader, Request $request)
    {    
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            $uploader->enableCORS($_SERVER['HTTP_ORIGIN']);
        }

        if ($request->server('REQUEST_METHOD') == 'OPTIONS') {
            exit;
        }

        $json = $uploader->handle($request->file('filedata'),$request->user());

        if ($json !== false) {
            return response()->json($json, 200);
        }

        return response()->json('error', 400);
    }

	/**
     * Save the changed password
     * POST /publisher/settings/changePassword
     *
     * @return Response
     */
    public function changePassword($domain, Hasher $hasher, ChangePasswordForm $form, Request $request)
    {
        try
        {
            $input = $request->all();
            $user = $request->user();
            
            $form->validate($input);
            
            $oldPassword   = $input['old_password'];
            $password       = $input['password'];

            // test input password against the existing one
            if($hasher->check($oldPassword, $user->password))
            {
                $user->password = $hasher->make($password);

                if($user->save())
                    return response()->json(['sucess' => true]);
            } 
            else
            {
                return response()->json(['success' => false,'errors' => 'You old password is incorrect.']);
            }
        }
        catch(FormValidationException $e)
        {
            return response()->json(['success' => false,'errors' => $e->getErrors()->all()]);
        }

        return response()->json(['success' => false,'errors' => 'Your password could not be changed, try later.']);
    }
}