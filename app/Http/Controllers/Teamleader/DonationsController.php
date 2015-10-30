<?php 

namespace Helpsmile\Http\Controllers\Teamleader;

use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Repositories\DonationRepositoryInterface;
use Helpsmile\Repositories\DonorRepositoryInterface;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Repositories\NotificationRepositoryInterface;
use Helpsmile\Transformers\NotificationTransformer;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Services\Forms\DonationCreationForm;
use Helpsmile\Services\Forms\DonorDonationCreationForm;
use Helpsmile\Services\Forms\UnassignedDonationUpdateForm;
use Helpsmile\Exceptions\DonationNotFoundException;

class DonationsController extends Controller {

    /**
     * Donor repository.
     *
     * @var \Helpsmile\Repositories\DonationRepositoryInterface
     */
    protected $donations;

    /**
     * Donor repository.
     *
     * @var \Helpsmile\Repositories\DonorRepositoryInterface
     */
    protected $donors;

    /**
     * User repository.
     *
     * @var \Helpsmile\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Notification repository.
     *
     * @var \Helpsmile\Repositories\NotificationRepositoryInterface
     */
    protected $notifications;

    /**
     * Create a new UsersController instance.
     *
     * @param  \Helpsmile\Repositories\DonationRepositoryInterface $donations
     * @param  \Helpsmile\Repositories\DonorRepositoryInterface $donors
     * @param  \Helpsmile\Repositories\UserRepositoryInterface $users
     * @param  \Helpsmile\Repositories\NotificationRepositoryInterface $notifications
     * @return void
     */
    public function __construct(DonationRepositoryInterface $donations, 
    	DonorRepositoryInterface $donors,
    	UserRepositoryInterface $users,
        NotificationRepositoryInterface $notifications){

        $this->donations = $donations;
        $this->donors = $donors;
        $this->users = $users;
        $this->notifications = $notifications;
    }

    /**
	 * Display a listing of the resource.
	 * GET /donors
	 *
	 * @return Response
	 */
	public function index($domain, Request $request)
    {
        $search = e($request->get('q'));
        $telecaller_id = $request->get('telecaller');
        $teamleader = $request->user();
        $telecallerList = $this->users->listAllTelecallersForOrganisation($request->user()->organisation);
        $telecallerList = ['All' => 'All'] + $telecallerList->toArray();
        
        if($search)
        {
        	$message = "Coudn't find any donations matching the term <strong>$search</strong> for you. We suggest you to go back and search for another term once more.";
            $donations = $this->donations->searchByTermForTeamleader($teamleader,$search);
            $term = $search;
        }
        else if($telecaller_id)
        {
            if($telecaller_id == 'All')
            {
                $donations = $this->donations->findAllUploadedByTeamleader($teamleader);
                $message = "You haven't added any donor's details, we suggest you to add one.";
                $term = 'All';
            }
            else
            {
                $telecaller = $this->users->findByIdForOrganisation($telecaller_id,$request->user()->organisation);
                $term = $telecaller->fullname;
                $donations = $this->donations->findAllForTeamleaderCreatedByTelecaller($teamleader,$telecaller_id);
            }

            $message = "No donations have been found for the telecaller you filtered.";
        }
        else
        {
            $donations = $this->donations->findAllUploadedByTeamleader($teamleader);
            $message = "You haven't added any donor's details, we suggest you to add one.";
            $term = 'All';
        }
		
        $notifications = $notifications = $this->notifications->getAllRecentForEmployee($request->user());
        $notificationsRoute = route('teamleader.notifications',$domain);
        return view('teamleader.donations.index',compact('domain','donations','message','telecallerList','term','notifications','notificationsRoute'));
	}

    /**
     * Display a listing of the resource.
     * GET /notifications
     *
     * @param  \Helpsmile\Transformers\NotificationTransformer $notificationTransformer
     * @return Response
     */
    public function notifications($domain, NotificationTransformer $notificationTransformer)
    {
        $notifications = $this->notifications->getAllRecentForEmployee(Auth::user());
                
        return response()->json([
            'success' => true,
            'data' => $notificationTransformer->transformCollection($notifications->toArray())
        ]);
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /donors/create
	 *
	 * @return Response
	 */
	public function create($domain)
    {
		$telecallerList = $this->users->listAllTelecallersForOrganisation(Auth::user()->organisation);
		return view('teamleader.donations.create',compact('domain','telecallerList'));
	}

	/**
     * Add the donation to the given donor
     * GET /donors/{id}/donations/create
     *
     * @param  int  $id
     * @return Response
     */
    public function addDonation($domain,$id)
    {
        $donor = $this->donors->findByIdForOrganisation($id,Auth::user()->organisation);
        $telecallerList = $this->users->listAllTelecallersForOrganisation(Auth::user()->organisation);
        return view('teamleader.donors.donation',compact('domain','donor','telecallerList'));
    }

    /**
     * Save the donation details for the given donor
     * POST /donors/{id}/donations
     *
     * @param  int  $id
     * @return Response
     */
    public function saveDonation($domain,$id, DonationCreationForm $form, Request $request)
    {
        try
        {
            $input = $request->all();
            $form->validate($input);
            $donor = $this->donors->findByIdForOrganisation($id,$request->user()->organisation);
            $data = array_merge($input,[
                'fullname' => $donor->fullname,
                'email' => $donor->email,
                'mobile' => $donor->mobile
            ]);
            $donation = $this->donations->uploadDonationDetailsForTeamleader($request->user(),$data);
            
            flash()->success("A donation has been added for {$donor->fullname} donor.");
            return redirect()->route('teamleader.donations.show',[$domain,$donation->id]);
        }
        catch (FormValidationException $e)
        {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /donors
	 *
	 * @return Response
	 */
	public function store($domain, DonorDonationCreationForm $form, Request $request)
    {
        try
        {
            $input = $request->all();
            $form->validate($input);
			$donation = $this->donations->uploadDonationDetailsForTeamleader($request->user(),$input); 
            
            flash()->success("A donation has been successfully added for the donor.");
            
            return redirect()->route('teamleader.donations.show',[$domain,$donation->donor->id]);
        }
        catch(FormValidationException $e)
        {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
	}

	/**
	 * Display the specified resource.
	 * GET /donors/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($domain,$id)
    {
        try
        {
            $donation = $this->donations->findByIdForTeamleader($id, Auth::user());
            return view('teamleader.donations.show',compact('domain','donation'));

        }
        catch(DonationNotFoundException $e)
        {
            $backLink = route('teamleader.donations.index',$domain);
            return view('errors.donationnotfound',compact('domain','backLink'));
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /donors/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($domain,$id)
    {
		$donation = $this->donations->findByIdForTeamleader($id, Auth::user());
		$telecallerList = $this->users->listAllTelecallersForOrganisation(Auth::user()->organisation);
		return view('teamleader.donations.edit',compact('domain','donation','telecallerList'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /teamleader/donations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($domain,$id, UnassignedDonationUpdateForm $form, Request $request)
    {	
        try
        {
            $input = $request->all();
            $form->validate($input);
            $donation = $this->donations->findByIdForTeamleader($id, $request->user());
            $donation = $this->donations->edit($donation,$input); 
            
            flash()->success("{$donation->donor->fullname} detail's have been succesfully updated!");
            return redirect()->route('teamleader.donations.show',[$domain,$donation->id]);
        }
        catch(FormValidationException $e)
        {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /donations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($domain,$id)
    { 
		$donation = $this->donations->findByIdForTeamleader($id, Auth::user());
        $donation->delete();

        flash()->success("You have successfully removed the donation.");
		return redirect()->route('teamleader.donations.index',$domain);
	}
}
