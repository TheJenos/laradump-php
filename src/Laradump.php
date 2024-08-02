<?php

namespace Thejenos\Laradump;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Thejenos\Laradump\Helpers\StackTracer;
use Thejenos\Laradump\Helpers\VarDump;
use Thejenos\Laradump\Traits\DumpCache;
use Thejenos\Laradump\Traits\DumpLogs;
use Thejenos\Laradump\Traits\DumpMails;
use Thejenos\Laradump\Traits\DumpQueries;

class Laradump
{
    use DumpMails;
    use DumpQueries;
    use DumpLogs;
    use DumpCache;

    private $active;
    private $url;

    public function __construct()
    {
        $this->active = ! (config('app.debug') == false || App::environment('production') || ! config('laradump.enable'));
        $this->url = config('laradump.url') . ':' . config('laradump.port') . '/';
    }

    public function __call($soapMethod, $params)
    {
        if (! $this->active) {
            return;
        }

        $this->{$soapMethod}($params);
    }

    public function sendRequest($data, $id = null)
    {
        try {
            if (! $id) {
                $id = uniqid();
            }

            $data = [
                'id' => $id,
                'style' => File::get(__DIR__ . '/../dist/main.css'),
                ...$data,
            ];

            Http::post($this->url, $data);
        } catch (\Throwable $th) {
        }
    }

    private function updateRequest($data, $id = null)
    {
        try {
            if (! $id) {
                $id = uniqid();
            }

            $data = [
                'id' => $id,
                'style' => File::get(__DIR__ . '/../dist/main.css'),
                ...$data,
            ];

            Http::put($this->url, $data);
        } catch (\Throwable $th) {
        }
    }

    private function clear()
    {
        try {
            Http::delete($this->url);
        } catch (\Throwable $th) {
        }
    }

    public function model(...$models)
    {
        foreach ($models as $model) {
            if (! $model instanceof \Illuminate\Database\Eloquent\Model) {
                $this->dump($model);

                continue;
            }
            
            $called_by = StackTracer::createTrace();

            $this->sendRequest([
                'class_name' => get_class($model),
                'model' => $model,
                'view' => view('laradump::model', [
                    'model' => $model,
                    'dump' => VarDump::customDumper($models->toArray()),
                    'relation' => VarDump::customDumper($model->getRelations()),
                    'call' => $called_by,
                ])->render(),
            ]);
        }
    }

    public function dump(...$args)
    {
        $called_by = StackTracer::createTrace();

        $this->sendRequest([
            'view' => view('laradump::dump', [
                'dumps' => collect($args)->map(function ($dumpValue) {
                    return VarDump::customDumper($dumpValue);
                }),
                'call' => $called_by,
            ])->render(),
        ]);
    }

    public function clearDumps()
    {
        $this->clear();
    }
}
