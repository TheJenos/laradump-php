<?php

namespace Thejenos\Laradump;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Thejenos\Laradump\Commands\LaradumpCommand;
use Thejenos\Laradump\Components\Badge;
use Thejenos\Laradump\Components\CallPath;
use Thejenos\Laradump\Observers\CacheObserver;
use Thejenos\Laradump\Observers\ExceptionObserver;
use Thejenos\Laradump\Observers\LogObserver;
use Thejenos\Laradump\Observers\QueryObserver;

class LaradumpServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laradump')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasCommand(LaradumpCommand::class);

        $this->app->bind(Laradump::class, function () {
            $laradump = new Laradump();

            return $laradump;
        });

        if (config('app.debug') == false || App::environment('production')) {
            return;
        }

        Blade::component('laradump-call-path', CallPath::class);
        Blade::component('laradump-badge', Badge::class);

        $observers = [
            QueryObserver::class,
            LogObserver::class,
            CacheObserver::class,
            ExceptionObserver::class,
        ];

        foreach ($observers as $observer) {
            $this->app->singleton($observer);
        }

        $this->app->get(ExceptionObserver::class);
    }
}
