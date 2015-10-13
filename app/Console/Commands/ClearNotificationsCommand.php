<?php namespace Helpsmile\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Helpsmile\Repositories\NotificationRepositoryInterface;

class ClearNotificationsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'helpsmile:clear-notifications';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clear the notifications.';

	/**
     * Notification repository.
     *
     * @var \Helpsmile\Repositories\NotificationRepositoryInterface
     */
    protected $notifications;

    /**
     * Create a new ClearNotificationsCommand instance.
     *
     * @param  \Helpsmile\Repositories\NotificationRepositoryInterface $notifications
     * @return void
     */
    public function __construct(NotificationRepositoryInterface $notifications){

        $this->notifications = $notifications;

        parent::__construct();
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->notifications->cleanUp();
		$this->info('All notifications representing transactions before 1 week have been cleared.');
	}
}
