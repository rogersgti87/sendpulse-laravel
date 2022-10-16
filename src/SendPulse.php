<?php

namespace Rogertiweb\SendPulse;

use Illuminate\Support\Facades\Facade;
use Rogertiweb\SendPulse\Contracts\SendPulseApi;

class SendPulse extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SendPulseApi::class;
    }
}
