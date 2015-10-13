<?php namespace Helpsmile\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Queue\Connectors\BeanstalkdConnector;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Queue;

class ClearBeanstalkdQueueCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'queue:beanstalkd:clear';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clear a Beanstalkd queue, by deleting all pending jobs.';

	/**
     * Config repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Beanstalkd connector.
     *
     * @var \Illuminate\Queue\Connectors\BeanstalkdConnector
     */
    protected $connector;

    /**
     * Create a new ClearBeanstalkdQueueCommand instance.
     *
     * @param  \Illuminate\Config\Repository $config
     * @return void
     */
    public function __construct(ConfigRepository $config, BeanstalkdConnector $connector){

        $this->config = $config;
        $this->connector = $connector;

        parent::__construct();
    }

	/**
	 * Defines the arguments.
	 *
	 * @return array
	 */
	public function getArguments()
	{
		return [
			['queue', InputArgument::OPTIONAL, 'The name of the queue to clear.'],
		];
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$config = $this->config->get('queue.connections.beanstalkd');
		$queue = ($this->argument('queue')) ? $this->argument('queue') : $config['queue'];

		$this->info(sprintf('Clearing queue: %s', $queue));

        $pheanstalk = $this->connector->connect($config)->getPheanstalk();
		$pheanstalk->useTube($queue);
		$pheanstalk->watch($queue);

		while ($job = $pheanstalk->reserve(0)) {			
			$pheanstalk->delete($job);
		}

		$this->info('...cleared.');
	}			

}