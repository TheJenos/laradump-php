<?php

use Thejenos\Laradump\Laradump;

if (!function_exists('laradump')) {
    function laradump(...$args): Laradump
    {
        $laradump = app(Laradump::class);

        if (!empty($args)) {
            $laradump->dump(...$args);
        }

        return $laradump;
    }
}
