<?php

namespace Thejenos\Laradump\Observers;

use Illuminate\Support\Facades\Event;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Cache\Events\KeyForgotten;
use Illuminate\Cache\Events\KeyWritten;
use Thejenos\Laradump\Helpers\StackTracer;
use Thejenos\Laradump\Helpers\VarDump;
use Thejenos\Laradump\Laradump;

class CacheObserver extends Observer
{
    private $status = false;

    public function register(): void
    {
        $events = [
            CacheHit::class,
            CacheMissed::class,
            KeyForgotten::class,
            KeyWritten::class,
        ];

        foreach ($events as $event) {
            Event::listen($event, [$this, 'onEvent']);
        }
    }

    public function onEvent($event)
    {
        if (!$this->status) {
            return;
        }

        laradump()->sendRequest([
            'view' => view('laradump::log', [
                'message' => class_basename($event) . " on `" . $event->key . "`",
                'context' => VarDump::customDumper($event),
                'call' => StackTracer::createTrace()
            ])->render(),
        ]);
    }

    public function enable()
    {
        $this->status = true;
    }

    public function disable()
    {
        $this->status = false;
    }
}
