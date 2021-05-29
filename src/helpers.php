<?php

use Illuminate\Contracts\Container\BindingResolutionException;
use Thejenos\Laradump\Laradump;

if (! function_exists('laradump')) {
    /**
     * @param mixed ...$args
     *
     * @return
     */
    function laradump()
    {
        return app(Laradump::class);
    }
}
