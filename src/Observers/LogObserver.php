<?php

namespace Thejenos\Laradump\Observers;

use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Log;
use Thejenos\Laradump\Helpers\StackTracer;
use Thejenos\Laradump\Helpers\VarDump;

class LogObserver extends Observer
{
    private $status = false;
    private $called_by;

    public function register(): void
    {
        Log::listen(function (MessageLogged $data) {
            if (! $this->status) {
                return;
            }

            if (empty($data->context)) {
                laradump()->sendRequest([
                    'view' => view('laradump::line', [
                        'title' => $data->message,
                        'badge' => [
                            'text' => ucfirst($data->level),
                            'color' => $data->level,
                        ],
                        'call' => StackTracer::createTrace(),
                    ])->render(),
                ]);

                return;
            }

            laradump()->sendRequest([
                'view' => view('laradump::log', [
                    'message' => $data->message,
                    'badge' => [
                        'text' => ucfirst($data->level),
                        'color' => $data->level,
                    ],
                    'context' => VarDump::customDumper($data->context),
                    'call' => StackTracer::createTrace(),
                ])->render(),
            ]);
        });
    }

    public function enable($called_by)
    {
        $this->status = true;
        $this->called_by = $called_by;
    }

    public function disable($called_by)
    {
        $this->status = false;
        $this->called_by = $called_by;
    }
}
