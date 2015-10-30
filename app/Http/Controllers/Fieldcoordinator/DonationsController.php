<?php 

namespace Helpsmile\Http\Controllers\Fieldcoordinator;

use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Repositories\DonationRepositoryInterface;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Repositories\NotificationRepositoryInterface;
use Helpsmile\Transformers\NotificationTransformer;
use Helpsmile\Services\Forms\DonationUpdateForm;
use Helpsmile\Services\Validation\FormValidationException;

class DonationsController extends Controller{

    /**
     * Donor repository.
     *
     * @var \Helpsmile\Repositories\DonationRepositoryInterface
     */
    protected $donation;

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
     * @param  \Helpsmile\Repositories\DonationRepositoryInterface $donation
     * @param  \Helpsmile\Repositories\UserRepositoryInterface $users
     * @param  \Helpsmile\Repositories\NotificationRepositoryInterface $notifications
     * @return void
     */
    public function __construct(DonationRepositoryInterface $donation, 
        UserRepositoryInterface $users,
        NotificationRepositoryInterface $notifications){

        $this->donations = $donation;
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
        $teamleader_id = $request->get('teamleader');
        
        $organisation = $request->user()->organisation;

        $teamleadersList = $this->users->listAllTeamleadersForOrganisation($organisation);
        $teamleadersList = ['All' => 'All'] + $teamleadersList->toArray();

        if($search)
        {
        	$message = "Coudn't find any donations matching the term <strong>'$search'</strong> for you. We suggest you to go back and search for another term once more.";
            $donations = $this->donations->searchUnassignedByTermForOrganisation($search,$organisation);
            $term = $search;
        }
        else if($teamleader_id)
        {
            if($teamleader_id == 'All')
            {
                $donations = $this->donations->findAllUnassignedPaginatedForOrganisation($organisation);
                $message = "There are no donation details currently, ask the teamleaders to upload the details !";
                $term = 'All';
            }
            else
            {
                $teamleader = $this->users->findByIdForOrganisation($teamleader_id,$organisation);
                $donations = $this->donations->findAllUnassignedUploadedByTeamleader($teamleader);
                $message = "No donation details have been uploaded by $teamleader->fullname yet !";
                $term = $teamleader->fullname;
            }
        }
        else
        {
            $donations = $this->donations->findAllUnassignedPaginatedForOrganisation($organisation);
            $message = "There are no donation details currently, ask the teamleaders to upload the details !";
            $term = 'All';
        }

        $notifications = $notifications = $this->notifications->getAllRecentForEmployee($request->user());
        $notificationsRoute = route('fieldcoordinator.notifications',$domain);
        return view('fieldcoordinator.donations.index',compact('domain','donations','message','teamleadersList','term','notifications','notificationsRoute'));
	}

    /**
     * Display a listing of the resource.
     * GET /notifications
     *
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
	 * Assign a field executive to visit the donor
	 * POST /donors/assign
	 *
	 * @return Response
	 */
	public function getPending($domain, Request $request)
    {
		$search = e($request->get('q'));
        $fieldexecutive_id = $request->get('fieldexecutive');

        $organisation = $request->user()->organisation;

        $fieldexecutivesList = $this->users->listAllFieldExecutivesForOrganisation($organisation);
        $fieldexecutivesList = ['All' => 'All'] + $fieldexecutivesList->toArray();

        if($search)
        {
        	$message = "Coudn't find any donations matching the term <strong>'$search'</strong> for you. We suggest you to go back and search for another term once more.";
        	$donations = $this->donations->searchPendingByTermForOrganisation($search, $organisation);
        	$term = $search;
        }
        else if($fieldexecutive_id)
        {
        	if($fieldexecutive_id == 'All')
            {
                $donations = $this->donations->findAllPendingPaginatedForOrganisation($organisation);
                $message = "There are no pending donations. Please assign field executives to unassigned donations.";
                $term = 'All';
            }
            else
            {
                $fieldexecutive = $this->users->findByIdForOrganisation($fieldexecutive_id, $organisation);
                $donations = $this->donations->findAllPendingAssignedForFieldExecutive($fieldexecutive);
                $message = "No donations been assigned for $fieldexecutive->fullname yet.";
                $term = $fieldexecutive->fullname;
            }
        }
        else
        {
            $donations = $this->donations->findAllPendingPaginatedForOrganisation($organisation);
            $message = "There are no pending donations. Please assign field executives to unassigned donations.";
            $term = 'All';
        }

        return view('fieldcoordinator.donations.pending',compact('domain','donations','message','fieldexecutivesList','term'));
	}

    /**
     * Assign a field executive to visit the donor
     * POST /donors/timeline
     *
     * @return Response
     */
    public function getPendingInTimeline($domain)
    {
        $donations = $this->donations->findAllPendingPaginatedForOrganisation(Auth::user()->organisation);
        
        $message = "There are no pending donations. Please assign field executives to unassigned donations.";
        return view('fieldcoordinator.donations.timeline',compact('domain','donations','message'));
    }

	/**
	 * Assign a field executive to visit the donor
	 * POST /donors/assign
	 *
	 * @return Response
	 */
	public function getDonated($domain, Request $request)
    {
		$search = e($request->get('q'));
        $teamleader_id = $request->get('teamleader');

        $organisation = $request->user()->organisation;
        $teamleadersList = $this->users->listAllTeamleadersForOrganisation($organisation);
        $teamleadersList = ['All' => 'All'] + $teamleadersList->toArray();
        
        if($search)
        {
        	$message = "Coudn't find any donations matching the term <strong>'$search'</strong> for you. We suggest you to go back and search for another term once more.";
            $donations = $this->donations->searchDonatedByTermForOrganisation($search, $organisation);
            $term = $search;
        }
        else if($teamleader_id)
        {
        	if($teamleader_id == 'All')
            {
                $donations = $this->donations->findAllDonatedPaginatedForOrganisation($organisation);
                $message = "There are no donated donations to view. We haven't received any donations yet.";
                $term = 'All';
            }
            else
            {
                $teamleader = $this->users->findByIdForOrganisation($teamleader_id, $organisation);
                $donations = $this->donations->findAllDonatedUploadedByTeamleader($teamleader);
                $message = "No donation details have been uploaded by $teamleader->fullname yet !";
                $term = $search;
            }
        }
        else
        {
            $donations = $this->donations->findAllDonatedPaginatedForOrganisation($organisation);
            $message = "There are no donated donations to view. We haven't received any donations yet.";
            $term = 'All';
        }

        return view('fieldcoordinator.donations.donated',compact('domain','donations','message','teamleadersList','term'));
	}

	/**
	 * Assign a field executive to visit the donor
	 * POST /donors/assign
	 *
	 * @return Response
	 */
	public function getDisinterested($domain, Request $request)
    {
		$search = e($request->get('q'));
        $teamleader_id = $request->get('teamleader');
        
        $organisation = $request->user()->organisation;

        $teamleadersList = $this->users->listAllTeamleadersForOrganisation($organisation);
        $teamleadersList = ['All' => 'All'] + $teamleadersList->toArray();

        if($search)
        {
        	$message = "Coudn't find any donations matching the term <strong>'$search'</strong> for you. We suggest you to go back and search for another term once more.";
            $donations = $this->donations->searchDisinterestedByTermForOrganisation($search, $organisation);
            $term = $search;
        }
        else if($teamleader_id)
        {
        	if($teamleader_id == 'All')
            {
                $donations = $this->donations->findAllDisinterestedPaginatedForOrganisation($organisation);
                $message = "There are no disinterested donations so far. No donor has cancelled their donation till now.";
                $term = 'All';
            }
            else
            {
                $teamleader = $this->users->findByIdForOrganisation($teamleader_id, $organisation);
                $donations = $this->donations->findAllDisinterestedUploadedByTeamleader($teamleader);
                $message = "No donation details have been uploaded by $teamleader->fullname yet !";
                $term = $teamleader->fullname;
            }
        }
        else
        {
            $donations = $this->donations->findAllDisinterestedPaginatedForOrganisation($organisation);
            $message = "There are no disinterested donations so far. No donor has cancelled their donation till now.";
            $term = 'All';
        }

        return view('fieldcoordinator.donations.disinterested',compact('domain','donations','message','teamleadersList','term'));
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
	    $organisation = Auth::user()->organisation;	
		$donation = $this->donations->findByIdForOrganisation($id,$organisation);
		$fieldexecutiveList = $this->users->listAllFieldExecutivesForOrganisation($organisation);
        
        return view('fieldcoordinator.donations.show',compact('domain','donation','fieldexecutiveList'));
	}

	/**
	 * Assign a field executive to visit the donor
	 * POST /donations/{id}/assign
	 *
	 * @return Response
	 */
	public function postAssign($domain, $id, Request $request)
	{
        $organisation = $request->user()->organisation;
        $donation = $this->donations->findByIdForOrganisation($id,$organisation);
        $fieldexecutive = $this->users->findByIdForOrganisation($request->get('fieldexecutive_id'), $organisation);
		$donor = $this->donations->assignFieldExecutiveForDonation($fieldexecutive,$donation);
		
		flash()->success($donor->fieldexecutive->fullname  . " has been assigned to meet {$donation->donor->fullname}.");
		return redirect()->route('fieldcoordinator.donations.getPending',compact('domain'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /donations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($domain,$id)
	{	
        $organisation = Auth::user()->organisation;
		$donation = $this->donations->findByIdForOrganisation($id,$organisation);
		$fieldexecutiveList = $this->users->listAllFieldExecutivesForOrganisation($organisation);
		
        return view('fieldcoordinator.donations.edit',compact('domain','donation','fieldexecutiveList'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /fieldcoordinator/donation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($domain, $id, DonationUpdateForm $form, Request $request)
    {	
		try
        {
            $input = $request->all();
            $form->validate($input);
            $donation = $this->donations->findByIdForOrganisation($id,$request->user()->organisation);
            $donation = $this->donations->edit($donation,$input); 
            
            flash()->success("You have successfully updated the donation details.");
            return redirect()->route('fieldcoordinator.donations.show',[$domain,$donation->id]);
        }
        catch(FormValidationException $e)
        {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /donors/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($domain,$id)
	{
		$donation = $this->donations->findByIdForOrganisation($id,Auth::user()->organisation);
        
        if($donation->status == 'donated' || $donation->status == 'disinterested'){

            flash()->error('Sorry you cannot remove the donation details. The donation is either cancelled or complete.');
            return redirect()->route('fieldcoordinator.donations.show',[$domain,$id]);
        }

        $donation->delete();
        flash()->success("You have successfully removed the donation details.");
        return redirect()->route('fieldcoordinator.donations.index',$domain);
	}

}