<?php

namespace Thejenos\Laradump\Observers;

abstract class Observer
{
    public function __construct()
    {
        $this->register();
    }

    abstract public function register();
}
