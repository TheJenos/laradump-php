<?php

namespace Thejenos\Laradump\Observers;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
use Thejenos\Laradump\Helpers\StackTracer;
use Thejenos\Laradump\Helpers\VarDump;

class ExceptionObserver extends Observer
{
    public function register(): void
    {
        Event::listen(RequestHandled::class, function (RequestHandled $data) {
            if (! isset($data) || ! isset($data->response) || ! isset($data->response->exception)) {
                return;
            }

            $exception = $data->response->exception;

            laradump()->sendRequest([
                'view' => view('laradump::log', [
                    'message' => $exception->getMessage(),
                    'badge' => [
                        'text' => 'Exception',
                        'color' => 'error',
                    ],
                    'context' => VarDump::customDumper($exception),
                    'call' => StackTracer::createTraceForThrowable($exception),
                ])->render(),
            ]);
        });
    }
}
