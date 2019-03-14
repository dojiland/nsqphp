<?php

namespace Per3evere\Nsq\Facades;

class Nsq extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return 'nsq';
    }
}
