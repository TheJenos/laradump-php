<?php

namespace Thejenos\Laradump;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Thejenos\Laradump\Laradump
 */
class LaradumpFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laradump';
    }
}
