<?php 

namespace Helpsmile\Http\Controllers\Manager;

use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Repositories\DonationRepositoryInterface;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Exceptions\DonationNotFoundException;

class EmployeesController extends Controller {

    /**
     * User repository.
     *
     * @var \Helpsmile\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new DashboardController instance.
     * 
     * @param  \Helpsmile\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users){

        $this->users = $users;
    }

    /**
	 * Display a listing of the employees.
	 * GET /manager/telecallers
	 *
	 * @return Response
	 */
	public function telecallers($domain)
	{
        $telecallers = $this->users->getTelecallersStatisticsForOrganisation(Auth::user()->organisation);

        return view('manager.employees.telecallers',compact('domain','telecallers'));
    }

    /**
     * Display a listing of the employees.
     * GET /manager/teamleaders
     *
     * @return Response
     */
    public function teamleaders($domain)
    {
        $teamleaders = $this->users->getTeamleadersStatisticsForOrganisation(Auth::user()->organisation);

        return view('manager.employees.teamleaders',compact('domain','teamleaders'));
    }

     /**
     * Display a listing of the employees.
     * GET /manager/fieldexecutives
     *
     * @return Response
     */
    public function fieldexecutives($domain)
    {
        $fieldexecutives = $this->users->getFieldexecutivesStatisticsForOrganisation(Auth::user()->organisation);

        return view('manager.employees.fieldexecutives',compact('domain','fieldexecutives'));
    }
}
