<?php

namespace Thejenos\Laradump\Facades;

use Illuminate\Support\Facades\Facade;
use Thejenos\Laradump\Laradump as LaradumpMain;

/**
 * @see \Thejenos\Laradump\Laradump
 */
class Laradump extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LaradumpMain::class;
    }
}
