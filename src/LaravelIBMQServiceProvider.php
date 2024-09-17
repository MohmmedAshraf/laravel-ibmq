<?php

namespace Outhebox\LaravelIBMQ;

use Outhebox\LaravelIBMQ\Commands\LaravelIBMQCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelIBMQServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-ibmq')
            ->hasConfigFile()
            ->hasCommand(LaravelIBMQCommand::class);
    }
}
