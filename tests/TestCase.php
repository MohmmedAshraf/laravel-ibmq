<?php

namespace Outhebox\LaravelIBMQ\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Outhebox\LaravelIBMQ\LaravelIBMQServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelIBMQServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}
