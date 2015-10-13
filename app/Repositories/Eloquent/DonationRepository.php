<?php namespace Helpsmile\Repositories\Eloquent;

use Helpsmile\User;
use Helpsmile\Donation;
use Helpsmile\Donor;
use Helpsmile\Address;
use Helpsmile\Organisation;
use Illuminate\Foundation\Application;
use Helpsmile\Services\Forms\LoginForm;
use Helpsmile\Repositories\DonationRepositoryInterface;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Exceptions\DonorNotFoundException;
use Helpsmile\Exceptions\DonationNotFoundException;
use Helpsmile\Events\EventGenerator;
use Helpsmile\Events\DispatchableTrait;
use Helpsmile\Events\Donors\NewDonorHasAgreedToContribute;
use Helpsmile\Events\Donors\ExistingDonorHasAgreedToContribute;
use Helpsmile\Events\Donations\FieldExecutiveWasAssignedForDonation;
use Helpsmile\Events\Donations\DonationWasSuccessful;
use Helpsmile\Events\Donations\DonationWasCancelled;
use Carbon\Carbon;

class DonationRepository extends AbstractRepository implements DonationRepositoryInterface{

    /**
     * User repository.
     *
     * @var \Helpsmile\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Laravel native IOC Container class
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Pull in the EventGenerator trait the raise and release events
     *
     * @var \Helpsmile\Events\EventGenerator
     */
    use EventGenerator;

    /**
     * Pull in the DispatchableTrait to fire the released events
     *
     * @var \Helpsmile\Events\DispatchableTrait
     */
    use DispatchableTrait;

    /**
     * Create a new DbDonationRepository instance.
     *
     * @param  \Helpsmile\Donation  $donation
     * @return void
     */
    public function __construct(Donation $donation, UserRepositoryInterface $users, Application $app)
    {
        $this->model = $donation;
        $this->users = $users;
        $this->app = $app;
    }

    /**
     * Get the donor donation creation form service.
     * Validates the rules for creating donation with donor details.
     * This happens when the donor is making a donation for the first time.
     *
     * @return \Helpsmile\Services\Forms\DonationCreationForm
     */
    public function getDonorDonationCreationForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\DonorDonationCreationForm');
    }

    /**
     * Get the donation creation form service.
     * Validate the donation details.
     * This happens when an existing donor is making a donation.
     *
     * @return \Helpsmile\Services\Forms\DonationCreationForm
     */
    public function getDonationCreationForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\DonationCreationForm');
    }

    /**
     * Get the donation creation form service.
     * Validates the donation details before updating them.
     * This happens when donation details are updated after a fieldexecutive is assigned.
     *
     * @return \Helpsmile\Services\Forms\DonationUpdateForm
     */
    public function getDonationUpdateForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\DonationUpdateForm');
    }

    /**
     * Get the donation completion form service.
     * Validates the donation details before updating them to allow for completion.
     * This happens when donation details are updated from the mobile application.
     *
     * @return \Helpsmile\Services\Forms\DonationCompletionForm
     */
    public function getDonationCompletionForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\DonationCompletionForm');
    }

    /**
     * Get the donation creation form service.
     * Validates the donation details before updating them.
     * This happens when donation details are updated before a fieldexecutive is assigned.
     * 
     * @return \Helpsmile\Services\Forms\DonationUpdateForm
     */
    public function getUnassignedDonationUpdateForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\UnassignedDonationUpdateForm');
    }

    /**
     * Find all the donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllUploadedByTeamleader(User $teamleader, $perPage = 8)
    {
        $donations = $teamleader->uploadedDonations()
                                ->with('donor')
                                ->with('address')
                                ->orderBy('appointment', 'asc')
                                ->paginate($perPage);
        return $donations;
    }

    /**
     * Find all the unassigned donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllUnassignedUploadedByTeamleader(User $teamleader, $perPage = 8)
    {
        $donations = $teamleader->uploadedDonations()
                                ->with('donor')
                                ->with('address')
                                ->where('status','unassigned')
                                ->orderBy('appointment', 'asc')
                                ->paginate($perPage);
        return $donations;
    }

    /**
     * Find all the pending donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPendingUploadedByTeamleader(User $teamleader, $perPage = 8)
    {
        $donations = $teamleader->uploadedDonations()
                             ->with('donor')
                             ->with('address')
                             ->where('status','pending')
                             ->orderBy('appointment', 'asc')
                             ->paginate($perPage);
        return $donations;
    }

    /**
     * Find all the donated donations which were uploaded by the given teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDonatedUploadedByTeamleader(User $teamleader, $perPage = 8)
    {
        $donations = $teamleader->uploadedDonations()
                             ->with('donor')
                             ->with('address')
                             ->where('status','donated')
                             ->orderBy('appointment', 'asc')
                             ->paginate($perPage);
        return $donations;
    }

     /**
     * Find all the disinterested donations which were uploaded by the teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDisinterestedUploadedByTeamleader(User $teamleader, $perPage = 8)
    {
        $donations = $teamleader->uploadedDonations()
                                ->with('donor')
                                ->with('address')
                                ->where('status','disinterested')
                                ->orderBy('appointment', 'asc')
                                ->paginate($perPage);
        return $donations;
    }

    /**
     * Find all the pending donations assigned for the given fieldexecutive.
     *
     * @param  \Helpsmile\User $executive
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPendingAssignedForFieldExecutive(User $executive, $perPage = 8)
    {
        $donations = $executive->assignedDonations()
                               ->with('donor')
                               ->with('address')
                               ->where('status','pending')
                               ->orderBy('appointment', 'asc')
                               ->paginate($perPage);

        return $donations;
    }

    /**
     * Find all the donated donations  assigned for the given fieldexecutive.
     *
     * @param  \Helpsmile\User $executive
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDonatedAssignedForFieldExecutive(User $executive, $perPage = 8)
    {
        $donations = $executive->assignedDonations()
                               ->with('donor')
                               ->with('address')
                               ->where('status','donated')
                               ->orderBy('appointment', 'asc')
                               ->paginate($perPage);

        return $donations;
    }

    /**
     * Find all the donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPaginatedForOrganisation(Organisation $organisation, $perPage = 8)
    {
        $donations = $organisation->donations()
                                 ->with('donor')
                                 ->with('address')
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);
        return $donations;
    }

    /**
     * Find all unassigned donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllUnassignedPaginatedForOrganisation(Organisation $organisation, $perPage = 8)
    {
        $donations = $organisation->donations()
                                 ->with('donor')
                                 ->with('address')
                                 ->where('status','unassigned')
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);
        return $donations;
    }

    /**
     * Find all pending donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllPendingPaginatedForOrganisation(Organisation $organisation, $perPage = 8)
    {
        $donations = $organisation->donations()
                                 ->with('donor')
                                 ->with('address')
                                 ->where('status','pending')
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);

        return $donations;
    }

    /**
     * Find all donated donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDonatedPaginatedForOrganisation(Organisation $organisation, $perPage = 8)
    {
        $donations = $organisation->donations()
                                 ->with('donor')
                                 ->with('address')
                                 ->where('status','donated')
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);

        return $donations;
    }

    /**
     * Find all disinterested donations from the given organisation.
     *
     * @param  integer $perPage
     * @param  \Helpsmile\Organisation $organisation
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllDisinterestedPaginatedForOrganisation(Organisation $organisation, $perPage = 8)
    {
        $donations = $organisation->donations()
                              ->with('donor')
                              ->with('address')
                              ->where('status','disinterested')
                              ->orderBy('appointment', 'asc')
                              ->paginate($perPage);

        return $donations;
    }

    /**
     * Search for all unassigned donations based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchUnassignedByTermForOrganisation($term, Organisation $organisation, $perPage = 8)
    {
        $donations = $this->model->with('donor')
                                 ->with('address')
                                 ->join('donors', 'donors.id', '=', 'donations.donor_id')
                                 ->join('addresses', 'addresses.donation_id', '=', 'donations.id')
                                 ->where(function($query) use ($organisation){
                                    $query->where('status','unassigned')
                                          ->where('organisation_id',$organisation->id);
                                 })
                                 ->where(function($query) use($term)
                                 {
                                    $query->where('fullname', 'LIKE', '%'.$term.'%')
                                          ->orWhere('address', 'LIKE', '%'.$term.'%')
                                          ->orWhere('mobile', 'LIKE', '%'.$term.'%')
                                          ->orWhere('promised_amount', 'LIKE', '%'.$term.'%');  
                                })
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);
        return $donations;
    }

    /**
     * Search for all pending donations based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchPendingByTermForOrganisation($term, Organisation $organisation, $perPage = 8)
    {   
        $donations = $this->model->with('donor')
                                 ->with('address')
                                 ->join('donors', 'donors.id', '=', 'donations.donor_id')
                                 ->join('addresses', 'addresses.donation_id', '=', 'donations.id')
                                 ->where(function($query) use ($organisation){
                                    $query->where('status','pending')
                                          ->where('organisation_id',$organisation->id);
                                 })
                                 ->where(function($query) use($term)
                                 {
                                    $query->where('fullname', 'LIKE', '%'.$term.'%')
                                          ->orWhere('address', 'LIKE', '%'.$term.'%')
                                          ->orWhere('mobile', 'LIKE', '%'.$term.'%')
                                          ->orWhere('promised_amount', 'LIKE', '%'.$term.'%');  
                                })
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);
        return $donations;
    }

    /**
     * Search for all donated donations based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchDonatedByTermForOrganisation($term, Organisation $organisation, $perPage = 8)
    {    
        $donations = $this->model->with('donor')
                                 ->with('address')
                                 ->join('donors', 'donors.id', '=', 'donations.donor_id')
                                 ->join('addresses', 'addresses.donation_id', '=', 'donations.id')
                                 ->where(function($query) use ($organisation){
                                    $query->where('status','donated')
                                          ->where('organisation_id',$organisation->id);
                                 })
                                 ->where(function($query) use($term)
                                 {
                                    $query->where('fullname', 'LIKE', '%'.$term.'%')
                                          ->orWhere('address', 'LIKE', '%'.$term.'%')
                                          ->orWhere('mobile', 'LIKE', '%'.$term.'%')
                                          ->orWhere('promised_amount', 'LIKE', '%'.$term.'%');  
                                })
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);
        return $donations;
    }

    /**
     * Search for all disinterested donations based on the given term from the given organisation.
     *     
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchDisinterestedByTermForOrganisation($term, Organisation $organisation, $perPage = 8)
    {    
        $donations = $this->model->with('donor')
                                 ->with('address')
                                 ->join('donors', 'donors.id', '=', 'donations.donor_id')
                                 ->join('addresses', 'addresses.donation_id', '=', 'donations.id')
                                 ->where(function($query) use ($organisation){
                                    $query->where('status','disinterested')
                                          ->where('organisation_id',$organisation->id);
                                 })
                                 ->where(function($query) use($term)
                                 {
                                    $query->where('fullname', 'LIKE', '%'.$term.'%')
                                          ->orWhere('address', 'LIKE', '%'.$term.'%')
                                          ->orWhere('mobile', 'LIKE', '%'.$term.'%')
                                          ->orWhere('promised_amount', 'LIKE', '%'.$term.'%');  
                                })
                                 ->orderBy('appointment', 'asc')
                                 ->paginate($perPage);
        return $donations;
    }

    /**
     * Search for all donations uploaded by the teamleader based on the given term.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  string $term
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function searchByTermForTeamleader(User $teamleader,$term,$perPage = 8)
    {
        $donations = $teamleader->uploadedDonations()
                                ->with('donor')
                                ->with('address')
                                ->join('donors', 'donors.id', '=', 'donations.donor_id')
                                ->join('addresses', 'addresses.donation_id', '=', 'donations.id')
                                ->where(function($query) use($term)
                                {
                                        $query->where('fullname', 'LIKE', '%'.$term.'%')
                                        ->orWhere('address', 'LIKE', '%'.$term.'%')
                                        ->orWhere('mobile', 'LIKE', '%'.$term.'%')
                                        ->orWhere('promised_amount', 'LIKE', '%'.$term.'%');  
                                
                                })
                                ->orderBy('appointment', 'asc')
                                ->paginate($perPage); 
        return $donations;
    }

    /**
     * Save the donation details for the given teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  array $data
     * @return \Helpsmile\Donation
     */
    public function uploadDonationDetailsForTeamleader(User $teamleader, array $data)
    {
        $organisation = $teamleader->organisation;

        $first = $organisation->donors()->where('email',$data['email'])->first();

        if(is_null($first)){

            $donor = new Donor;
            $donor->fill([
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'mobile' => $data['mobile']
            ]);
            $organisation->donors()->save($donor);
        }
        else
            $donor = $first;

        $donation = $this->getNew();
        $donation->promised_amount     = $data['promised_amount'];
        $donation->appointment  = new Carbon($data['appointment']);
        $donation->telecaller_id = $data['telecaller_id'];
        $donation->donor()->associate($donor);
        $donation = $teamleader->uploadedDonations()->save($donation);

        $address = new Address;
        $address->address  = $data['address'];
        $address->location  = $data['location'];
        $address->latitude  = $data['latitude'];
        $address->longitude  = $data['longitude'];
        $donation->address()->save($address);

        if(is_null($first))
            $this->raise(new NewDonorHasAgreedToContribute($donor, $donation));
        else
            $this->raise(new ExistingDonorHasAgreedToContribute($donor, $donation));

        $this->dispatchEventsFor($this);
        
        return $donation;    
    }

    /**
     * Update the donation details.
     *
     * @param  \Helpsmile\User $donation
     * @param  array $data
     * @return \Helpsmile\User
     */
    public function edit(Donation $donation, array $data)
    {
        $donation->promised_amount     = $data['promised_amount'];
        $donation->appointment  = new Carbon($data['appointment']);
        
        if(isset($data['telecaller_id']))
            $donation->telecaller_id = $data['telecaller_id'];

        if(isset($data['fieldexecutive_id'])){
            $donation->status = 'pending';
            $donation->fieldexecutive_id = $data['fieldexecutive_id'];
        }

        $donation->save();

        $address = $donation->address;
        $address->address = $data['address'];
        $address->location = $data['location'];
        $address->latitude = $data['latitude'];
        $address->longitude = $data['longitude'];
        $address->save();

        return $donation;
    }

    /**
     * Find the donation with the curresponding id from the given organisation.
     *
     * @param  integer $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Donation
     */
    public function findByIdForOrganisation($id, Organisation $organisation)
    { 
        $donation = $organisation->donations()
                                 ->select('donations.*')
                                 ->where('donations.id', $id)
                                 ->first();
        
        if(is_null($donation))
            throw new DonationNotFoundException("The donation with id as $id does not exist for the organisation {$organisation->name}");

        return $donation;
    }

    /**
     * Find the donation with the specified id for the given teamleader
     *
     * @param  integer $donationid
     * @param  \Helpsmile\User $teamleader
     * @return \Helpsmile\Donation
     */
    public function findByIdForTeamleader($donationid, User $teamleader)
    {    
        $donation = $teamleader->uploadedDonations()->find($donationid);

        if(is_null($donation))
            throw new DonationNotFoundException('The donation with id as "'.$donationid.'" does not exist!');

        return $donation;
    }

    /**
     * Find the donation with the specified id assigned for the field executive.
     *
     * @param  integer $donationid
     * @param  \Helpsmile\User $executive
     * @return \Helpsmile\Donation
     */
    public function findByIdAssignedForFieldExecutive($donationid, User $executive)
    {
        
        $donation = $executive->assignedDonations()->where('status','pending')->with('donor')->with('address')->find($donationid);
        
        if(is_null($donation))
            throw new DonationNotFoundException('The donation with id as "'.$donationid.'" does not exist!');

        return $donation;
    }

    /**
     * Mark the given donation as donated and persist the donated amount.
     *
     * @param  \Helpsmile\Donation $donation
     * @param  integer $donated_amount
     * @return \Helpsmile\Donation
     */
    public function markAsDonated(Donation $donation,$donated_amount)
    {
        $donation->donated_amount = $donated_amount;
        $donation->status = 'donated';
        $donation->donated_at = Carbon::now();

        $donation->save();

        $this->raise(new DonationWasSuccessful($donation));

        $this->dispatchEventsFor($this);

        return $donation;
    }

    /**
     * Mark the given donation as disinterested and persist the cancelled time.
     *
     * @param  \Helpsmile\Donation $donation
     * @return \Helpsmile\Donation
     */
    public function markAsDisinterested(Donation $donation)
    {
        $donation->status = 'disinterested';
        $donation->cancelled_at = Carbon::now();

        $donation->save();

        $this->raise(new DonationWasCancelled($donation));

        $this->dispatchEventsFor($this);

        return $donation;
    }

    /**
     * Find all donations created by the telecaller for the given teamleader.
     *
     * @param  \Helpsmile\User $teamleader
     * @param  integer $telecaller
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donation[]
     */
    public function findAllForTeamleaderCreatedByTelecaller(User $teamleader, $telecaller_id, $perPage = 8)
    {
        $donations = $teamleader->uploadedDonations()
                             ->with('donor')
                             ->with('address')
                             ->where('telecaller_id',$telecaller_id)
                             ->orderBy('appointment', 'asc')
                             ->paginate($perPage);

        return $donations;
    }

    /**
     * Assign the donation to the given field executive.
     *
     * @param  \Helpsmile\User $fieldexecutive_id
     * @return \Helpsmile\Donation $donation
     */
    public function assignFieldExecutiveForDonation(User $fieldexecutive, Donation $donation)
    {
        $donation->status = 'pending';
        
        $fieldexecutive->assignedDonations()->save($donation);

        $this->raise(new FieldExecutiveWasAssignedForDonation($donation));

        $this->dispatchEventsFor($this);

        return $donation;
    }

}
