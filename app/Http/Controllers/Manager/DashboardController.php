<?php 

namespace Helpsmile\Http\Controllers\Manager;

use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Helpsmile\Donation;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Repositories\UserRepositoryInterface;
use Helpsmile\Repositories\NotificationRepositoryInterface;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Exceptions\DonationNotFoundException;


class DashboardController extends Controller{
    
    /**
     * Notification repository.
     *
     * @var \Helpsmile\Repositories\NotificationRepositoryInterface
     */
    protected $notifications;

    /**
     * Create a new DashboardController instance.
     *
     * @param  \Helpsmile\Transformers\NotificationTransformer $notificationTransformer
     * @return void
     */
    public function __construct(NotificationRepositoryInterface $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * Display a listing of the resource.
     * GET /dashboard/reporting
     *
     * @return Response
     */
    public function reporting($domain)
    {
        $startDate = Donation::orderBy('created_at','asc')->get()->first()->created_at->startOfDay();
        $endDate = \Carbon\Carbon::now()->addDay()->startOfDay();

        $data = \DB::select('CALL donations_statistics(?,?,?,?)',array($startDate,$endDate,1,'DAY'));
        return response()->json(['sucess' => true,'data' => $data]);
    }

    /**
     * Display a listing of the resource.
     * GET /dashboard/notifications
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
	 * Display a listing of the resource.
	 * GET /dashboard
     *
     * @param  string $domain
     * @param  \Helpsmile\Repositories\UserRepositoryInterface $users
	 * @return Response
	 */
	public function index($domain, UserRepositoryInterface $users)
    {
        $today_start = \Carbon\Carbon::now()->startOfDay();
        $today_end = \Carbon\Carbon::now()->endOfDay();
        
        $donations = Donation::where('status','donated')->count();
        $raised = Donation::where('status','donated')->sum('donated_amount');
        $raised_today = Donation::where('status','donated')->where('donated_at','>=',$today_start)->where('donated_at','<=',$today_end)->sum('donated_amount');

        $unassigned = Donation::where('status','unassigned')->where('created_at','>=',$today_start)->where('created_at','<=',$today_end)->count();
        $pending = Donation::where('status','pending')->where('appointment','>=',$today_start)->where('appointment','<=',$today_end)->count();
        $donated = Donation::where('status','donated')->where('donated_at','>=',$today_start)->where('donated_at','<=',$today_end)->count();
        $disinterested = Donation::where('status','disinterested')->where('cancelled_at','>=',$today_start)->where('cancelled_at','<=',$today_end)->count();

        $teamleader = $users->getTeamleadersStatisticsForOrganisation(Auth::user()->organisation)->first();

        $notifications = $notifications = $this->notifications->getAllRecentForEmployee(Auth::user());
        $notificationsRoute = route('manager.dashboard.notifications',$domain);
        return view('manager.dashboard',compact('domain','donations','raised','unassigned','pending','donated','disinterested','raised_today','teamleader','notifications','notificationsRoute'));
    }
}
