<?php

namespace Thejenos\Laradump\Traits;

use Thejenos\Laradump\Helpers\StackTracer;
use Thejenos\Laradump\Observers\QueryObserver;

trait DumpQueries
{
    public function showQueries()
    {
        $called_by = StackTracer::createTrace();

        app(QueryObserver::class)->enable($called_by);
        $this->sendRequest([
            'view' => view('laradump::line', [
                'title' => 'Query capturing started',
                'call' => $called_by,
            ])->render(),
        ]);
    }

    public function stopShowingQueries()
    {
        $called_by = StackTracer::createTrace();

        app(QueryObserver::class)->disable($called_by);
        $this->sendRequest([
            'view' => view('laradump::line', [
                'title' => 'Query capturing ended',
                'call' => $called_by,
            ])->render(),
        ]);
    }
}
