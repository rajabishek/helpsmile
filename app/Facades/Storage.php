<?php namespace Helpsmile\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Helpsmile\Filesystem\FilesystemManager
 */
class Storage extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'filesystem';
    }
}