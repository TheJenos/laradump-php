<?php

namespace Thejenos\Laradump\Traits;

use Thejenos\Laradump\Helpers\StackTracer;
use Thejenos\Laradump\Observers\LogObserver;

trait DumpLogs
{
    public function showLogs()
    {
        $called_by = StackTracer::createTrace();
        app(LogObserver::class)->enable($called_by);
        $this->sendRequest([
            'view' => view('laradump::line', [
                'title' => 'Log capturing started',
                'call' => $called_by,
            ])->render(),
        ]);
    }

    public function stopShowingLogs()
    {
        $called_by = StackTracer::createTrace();
        app(LogObserver::class)->disable($called_by);
        $this->sendRequest([
            'view' => view('laradump::line', [
                'title' => 'Log capturing ended',
                'call' => $called_by,
            ])->render(),
        ]);
    }
}
