<?php namespace Helpsmile\Repositories\Eloquent;

use Helpsmile\Donor;
use Helpsmile\User;
use Helpsmile\Organisation;
use Illuminate\Foundation\Application;
use Helpsmile\Services\Forms\LoginForm;
use Helpsmile\Repositories\DonorRepositoryInterface;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Exceptions\DonorNotFoundException;
use Carbon\Carbon;

class DonorRepository extends AbstractRepository implements DonorRepositoryInterface{
    
    /**
     * Donor repository.
     *
     * @var \Helpsmile\Donor
     */
    protected $donors;

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
     * Create a new DbUserRepository instance.
     *
     * @param  \Helpsmile\Donor  $donor
     * @return void
     */
    public function __construct(donor $donor, UserRepositoryInterface $users, Application $app)
    {
        $this->model = $donor;
        $this->users = $users;
        $this->app = $app;
    }

    /**
     * Get the donor creation form service.
     *
     * @return \Helpsmile\Services\Forms\DonorCreationForm
     */
    public function getDonorCreationForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\DonorCreationForm');
    }

    /**
     * Get the donor creation form service.
     *
     * @return \Helpsmile\Services\Forms\DonorCreationForm
     */
    public function getDonorUpdateForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\DonorUpdateForm');
    }

    /**
     * Find all the donors from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\Donor[]
     */
    public function findAllPaginatedForOrganisation(Organisation $organisation, $perPage = 8)
    {
        $donors = $organisation->donors()->orderBy('fullname', 'asc')->paginate($perPage);
        
        return $donors;
    }

    /**
     * Search for all donors based on the given term from the given organisation.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile]
     */
    public function searchByTermForOrganisation($term, Organisation $organisation, $perPage = 8)
    {    
        $donors =  $organisation->donors()
                            ->where(function($query) use($term)
                            {
                                $query->where('fullname', 'LIKE', '%'.$term.'%')
                                ->orWhere('email', 'LIKE', '%'.$term.'%')
                                ->orWhere('mobile', 'LIKE', '%'.$term.'%');

                            })->orderBy('fullname', 'asc')
                              ->paginate($perPage);
        return $donors;
    }

    /**
     * Update the donor details in the database.
     *
     * @param  \Helpsmile\User $donor
     * @param  array $data
     * @return \Helpsmile\User
     */
    public function edit(Donor $donor, array $data){

        $donor->fullname        = $data['fullname'];
        $donor->email        = $data['email'];
        $donor->mobile     = $data['mobile'];
        $donor->save();

        return $donor;
    }

    /**
     * Find the donor with the curresponding id from the given organisation.
     *
     * @param  integer $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\Donor
     */
    public function findByIdForOrganisation($id, Organisation $organisation)
    {    
        $donor = $organisation->donors()->find($id);
        
        if(is_null($donor))
            throw new DonorNotFoundException('The donor with id as "'.$id.'" does not exist!');
        
        return $donor;
    }
}
