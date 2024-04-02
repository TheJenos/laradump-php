<?php

namespace Thejenos\Laradump\Observers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Thejenos\Laradump\Helpers\SqlFormatter;
use Thejenos\Laradump\Helpers\StackTracer;

class QueryObserver extends Observer
{
    private $status = false;
    private $called_by;

    public function register(): void
    {
        DB::listen(function (QueryExecuted $query) {
            if (! $this->status) {
                return;
            }

            $sqlQuery = str_replace(['?'], ['\'%s\''], $query->sql);
            $sqlQuery = vsprintf($sqlQuery, $query->bindings);

            laradump()->sendRequest([
                'view' => view('laradump::query', [
                    'query' => SqlFormatter::format($sqlQuery),
                    'time' => $query->time,
                    'connectionName' => $query->connectionName,
                    'call' => StackTracer::createTrace(),
                ])->render(),
            ]);
        });
    }

    public function enable($called_by)
    {
        DB::enableQueryLog();
        $this->status = true;
        $this->called_by = $called_by;
    }

    public function disable($called_by)
    {
        DB::disableQueryLog();
        $this->status = false;
        $this->called_by = $called_by;
    }
}
