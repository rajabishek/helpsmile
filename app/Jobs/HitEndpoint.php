<?php namespace Helpsmile\Jobs;

use Exception;
use Helpsmile\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Client;


class HitEndpoint extends Job implements SelfHandling, ShouldQueue
{
    /**
     * Guzzle instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Data to be handled.
     *
     * @var array
     */
    protected $data;

    /**
     * The number of minutes to wait before pinging the same endpoint.
     *
     * @var integer
     */
    protected $minutes = 10;

    /**
     * Create a new HitEndpoint instance.
     *
     * @param  array  $data
     * @param  \GuzzleHttp\Client  $client
     * @return void
     */
    public function __construct($data, Client $client)
    {
        $this->data = $data;  
        $this->client = $client;  
    }

    /**
     * Hit the endpoint with the given data for the change in the given object.
     *
     * @return boolean
     */
    public function handle()
    {
        try
        {
            extract($this->data);
            $objectdata = explode('.', $event);
            $objectid = $object['id'];

            $payload = [
                'object_type' => $objectdata[0],
                'object_id' => $objectid,
                'object_action' => $objectdata[1]
            ];

            $response = $this->client->request('POST', $url, ['json' => $payload]);

            if($response->getStatusCode() != 200){        
                throw new Exception("The enpoint {$url} did not return 200 response.");
            }

            $this->delete();
        }
        catch(Exception $e)
        {
            //Endpoint failed to return 200 response will pinging again after $this->minutes minutes.
            $this->release($this->minutes * 60);
        }
    }
}