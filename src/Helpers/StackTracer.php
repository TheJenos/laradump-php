<?php

namespace Thejenos\Laradump\Helpers;

use Spatie\Backtrace\Backtrace;
use Throwable;

class StackTracer
{
    public static function createTrace()
    {
        $backTrace = Backtrace::create()->frames();
        $lastTrace = collect($backTrace)->filter(function ($trace) {
            return !str_contains($trace->file, 'laradump')
                && !str_contains($trace->file, "laravel/framework");
        })->first();

        return [
            'class' => $lastTrace->class,
            'file_name' => basename($lastTrace->file),
            'file_path' => $lastTrace->file,
            'line' => $lastTrace->lineNumber,
        ];
    }

    public static function createTraceForThrowable(Throwable $tr)
    {
        $backTrace = Backtrace::createForThrowable($tr)->frames();
        $lastTrace = collect($backTrace)->filter(function ($trace) {
            return !str_contains($trace->file, 'laradump')
                && !str_contains($trace->file, "laravel/framework");
        })->first();

        return [
            'class' => $lastTrace->class,
            'file_name' => basename($lastTrace->file),
            'file_path' => $lastTrace->file,
            'line' => $lastTrace->lineNumber,
        ];
    }
}
