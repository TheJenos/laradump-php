<?php

namespace Thejenos\Laradump\Traits;

use Thejenos\Laradump\Helpers\StackTracer;
use Thejenos\Laradump\Observers\CacheObserver;

trait DumpCache
{
    public function showCache()
    {
        $called_by = StackTracer::createTrace();
        app(CacheObserver::class)->enable($called_by);
        $this->sendRequest([
            'view' => view('laradump::line', [
                'title' => 'Cache capturing started',
                'call' => $called_by,
            ])->render(),
        ]);
    }

    public function stopShowingCache()
    {
        $called_by = StackTracer::createTrace();
        app(CacheObserver::class)->disable($called_by);
        $this->sendRequest([
            'view' => view('laradump::line', [
                'title' => 'Cache capturing ended',
                'call' => $called_by,
            ])->render(),
        ]);
    }
}
