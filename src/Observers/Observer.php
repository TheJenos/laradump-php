<?php

namespace Thejenos\Laradump\Observers;

use Illuminate\Support\Facades\Event;

abstract class Observer
{
    public function __construct()
    {
        $this->register();
    }

    public abstract function register();
}
