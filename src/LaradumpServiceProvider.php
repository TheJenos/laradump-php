<?php

namespace Thejenos\Laradump;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Thejenos\Laradump\Commands\LaradumpCommand;
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
            ->hasCommand(LaradumpCommand::class);

        $this->app->bind(Laradump::class, function () {
            $laradump = new Laradump();
            $laradump->checkActive();

            return $laradump;
        });

        $this->app->bind(QueryObserver::class, function () {
            $observer = new QueryObserver();
            $observer->register();

            return $observer;
        });
    }
}
