<?php

namespace Thejenos\Laradump\Observers;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
use Spatie\Backtrace\Backtrace;
use Thejenos\Laradump\Helpers\VarDump;

class ExceptionObserver extends Observer
{
    public function register(): void
    {
        Event::listen(RequestHandled::class, function (RequestHandled $data) {
            if ($data->response->exception === null) {
                return;
            }

            $exception = $data->response->exception;

            $backTrace = Backtrace::createForThrowable($exception)->frames();
            $lastTrace = collect($backTrace)->filter(function ($trace) {
                return ! str_contains($trace->file, 'laradump')
                    && ! str_contains($trace->file, "laravel/framework");
            })->first();

            laradump()->sendRequest([
                'view' => view('laradump::log', [
                    'message' => $exception->getMessage(),
                    'badge' => [
                        'text' => 'Exception',
                        'color' => 'error',
                    ],
                    'context' => VarDump::customDumper($exception),
                    'call' => [
                        'class' => $lastTrace->class,
                        'file_name' => basename($lastTrace->file),
                        'file_path' => $lastTrace->file,
                        'line' => $lastTrace->lineNumber,
                    ],
                ])->render(),
            ]);
        });
    }
}
