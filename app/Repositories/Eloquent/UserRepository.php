<?php namespace Helpsmile\Repositories\Eloquent;

use Helpsmile\User;
use Helpsmile\Organisation;
use Helpsmile\Role;
use Illuminate\Foundation\Application;
use Illuminate\Hashing\BcryptHasher;
use Helpsmile\Services\Forms\LoginForm;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Exceptions\EmployeeNotFoundException;
use Queue;

class UserRepository extends AbstractRepository implements UserRepositoryInterface{

    /**
     * Create a new DbUserRepository instance.
     *
     * @param  \Helpsmile\User  $user
     * @return void
     */
    public function __construct(User $user,Application $app, BcryptHasher $hash)
    {
        $this->model = $user;
        $this->app = $app;
        $this->hash = $hash;
    }

    /**
     * Get the user login form service.
     *
     * @return \Helpsmile\Services\Forms\LoginForm
     */
    public function getLoginForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\LoginForm');
    }

    /**
     * Get the user creation form service.
     *
     * @return \Helpsmile\Services\Forms\UserCreationForm
     */
    public function getUserCreationForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\AddEmployeeForm');
    }

    /**
     * Get the user update form service.
     *
     * @return \Helpsmile\Services\Forms\UserCreationForm
     */
    public function getUserUpdateForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\EmployeeUpdateForm');
    }

    /**
     * Get the user update form service.
     *
     * @return \Helpsmile\Services\Forms\UserCreationForm
     */
    public function getSettingsForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\SettingsForm');
    }

    /**
     * Get the change password form service.
     *
     * @return \Helpsmile\Services\Forms\UserCreationForm
     */
    public function getChangePasswordForm()
    {
        return $this->app->make('Helpsmile\Services\Forms\ChangePasswordForm');
    }

    /**
     * Find all users paginated.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @param  int  $perPage
     * @return Illuminate\Database\Eloquent\Collection|\Helpsmile\User[]
     */
    public function findAllPaginatedForOrganisation($organisation, $perPage = 8)
    {
        return $organisation->users()
                    ->where('designation','!=','Admin')
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

   /**
     * Find the user by the given id belonging to the given organisation.
     *
     * @param  int  $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function findByIdForOrganisation($id, Organisation $organisation)
    {
        $employee = $organisation->users()->find($id);

        if(is_null($employee))
            throw new EmployeeNotFoundException('The employee with id as "'.$id.'" does not exist!');

        return $employee;
    }

    /**
     * Find the admin belonging to the given organisation.
     *
     * @param  int  $id
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function getAdminForOrganisation(Organisation $organisation)
    {
        $employee = $organisation->users()
                                ->with('organisation')
                                ->where('designation','Admin')
                                ->first();

        if(is_null($employee))
            throw new EmployeeNotFoundException("The employee with id as $id does not exist!");

        return $employee;
    }

    /**
     * Find the user by the given email address from the given organisation.
     *
     * @param  int  $email
     * @param  \Helpsmile\Organisation  $organisation
     * @return \Helpsmile\User
     */
    public function findByEmailForOrganisation($email, Organisation $organisation)
    {
        $employee = $organisation->users()->where('email',$email)->first();

        if(is_null($employee))
            throw new EmployeeNotFoundException("The employee having email as $email does not exist, for {$organisation->name}");

        return $employee;
    }

    /**
     * Return array of key-value (id => name) pairs of all users who are telecallers from the given organisation.
     *
     * @return array
     */
    public function listAllTelecallersForOrganisation(Organisation $organisation)
    {
        $telecallersList = $organisation->users()->where('designation','Telecaller')->lists('fullname','id');

        return $telecallersList;
    }

    /**
     * Return array of key-value (id => name) pairs of all users who are teamleaders from the given organisation.
     *
     * @return array
     */
    public function listAllTeamleadersForOrganisation(Organisation $organisation)
    {
        $teamLeaders = $organisation->users()->where('designation','Team Leader')->lists('fullname','id');

        return $teamLeaders;
    }

    /**
     * Return array of key-value (id => name) pairs of all users who are field-excutives from the given organisation.
     *
     * @return array
     */
    public function listAllFieldexecutivesForOrganisation(Organisation $organisation)
    {
        $teamLeaders = $organisation->users()->where('designation','Field Executive')->lists('fullname','id');

        return $teamLeaders;
    }

    /**
     * Find all users that match the given search term.
     *
     * @param  string $term
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Helpsmile\User[]
     */
    public function searchByTermPaginatedForOrganisation($term, Organisation $organisation, $perPage = 8){
        
        $users =  $organisation->users()
                       ->where(function($query){
                            $query->where('designation','!=','Admin');
                       })
                       ->where(function($query) use($term)
                       {
                            $query->where('fullname', 'LIKE', '%'.$term.'%')
                                  ->orWhere('email', 'LIKE', '%'.$term.'%')
                                  ->orWhere('mobile', 'LIKE', '%'.$term.'%')
                                  ->orWhere('designation', 'LIKE', '%'.$term.'%')
                                  ->orderBy('created_at', 'desc'); 
                        })
                        ->paginate($perPage);

        return $users;
    }

    /**
     * Find all users by their designation.
     *
     * @param  string $designation
     * @param  \Helpsmile\Organisation $organisation
     * @param  integer $perPage
     * @return array
     */
    public function searchByDesignationForOrganisation($designation, $organisation, $perPage = 8){
        if($designation == 'All')
            return $this->findAllPaginatedForOrganisation($organisation);
        $users =  $organisation->users()
                        ->where('designation',$designation)
                        ->orderBy('created_at', 'desc')
                        ->paginate($perPage);
        return $users;
    }

    /**
     * Create a new user in the database.
     *
     * @param  array $data
     * @return \Helpsmile\User
     */
    public function createForOrganisation(array $data, Organisation $organisation)
    {
        $user = $this->getNew();

        $user->email        = $data['email'];
        $user->fullname     = $data['fullname'];
        $user->password     = $this->hash->make($data['password']);
        $user->designation  = $data['designation'];
        
        if(isset($data['mobile']) && $data['mobile'])
            $user->mobile  = $data['mobile'];

        if(isset($data['address']) && $data['address'])
            $user->address  = $data['address'];
        
        $organisation->users()->save($user);

        // $role = Role::where('name',$data['designation'])->first();
        // $user->attachRole($role);

        return $user;
    }

    /**
     * Update the user in the database.
     *
     * @param  \Helpsmile\User $user
     * @param  array $data
     * @return \Helpsmile\User
     */
    public function edit(User $user, array $data){

        //In setting page the user is not allowed to change his email or designation
        if(isset($data['email']))
            $user->email  = $data['email'];
        
        if(isset($data['designation']))
            $user->designation  = $data['designation'];
        
        $user->fullname     = $data['fullname'];
        $user->mobile  = $data['mobile'];
        $user->address  = $data['address'];

        //Sometimes the admin can update other details apart from the password
        //Update the password only if the admin does it.
        if(isset($data['password']))
            $user->password = $this->hash->make($data['password']);

        $user->save();

        return $user;
    }

    /**
     * Get the performance of the telecallers from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function getTelecallersStatisticsForOrganisation(Organisation $organisation)
    {
        $data = User::leftJoin('donations', 'users.id', '=', 'donations.telecaller_id')
                    ->select('users.*', \DB::raw('SUM(COALESCE(donations.donated_amount, 0)) as total_earnings'), \DB::raw('COUNT(donations.donated_amount) as total_donations'))
                    ->where('designation','Telecaller')
                    ->where('organisation_id',$organisation->id)
                    ->groupBy('users.id')
                    ->orderBy('total_earnings','desc')
                    ->get();
        return $data;
    }

    /**
     * Get the performance of the teamleaders from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function getTeamleadersStatisticsForOrganisation(Organisation $organisation)
    {
        $data = User::leftJoin('donations', 'users.id', '=', 'donations.teamleader_id')
                    ->select('users.*', \DB::raw('SUM(COALESCE(donations.donated_amount, 0)) as total_earnings'), \DB::raw('COUNT(donations.donated_amount) as total_donations'))
                    ->where('designation','Team Leader')
                    ->where('organisation_id',$organisation->id)
                    ->groupBy('users.id')
                    ->orderBy('total_earnings','desc')
                    ->get();
        return $data;
    }

    /**
     * Get the performance of the field executives from the given organisation.
     *
     * @param  \Helpsmile\Organisation $organisation
     * @return \Helpsmile\User
     */
    public function getFieldexecutivesStatisticsForOrganisation(Organisation $organisation)
    {
        $data = User::leftJoin('donations', 'users.id', '=', 'donations.fieldexecutive_id')
                    ->select('users.*', \DB::raw('SUM(COALESCE(donations.donated_amount, 0)) as total_earnings'), \DB::raw('COUNT(donations.donated_amount) as total_donations'))
                    ->where('designation','Field Executive')
                    ->where('organisation_id',$organisation->id)
                    ->groupBy('users.id')
                    ->orderBy('total_earnings','desc')
                    ->get();

        return $data;
    }
}
