<?php 

namespace Helpsmile\Events\Contracts;

interface Dispatcher 
{

    /**
     * Dispatch all raised events.
     *
     * @param array $events
     */
    public function dispatch(array $events);

}
