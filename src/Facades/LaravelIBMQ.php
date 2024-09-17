<?php

namespace Outhebox\LaravelIBMQ\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Outhebox\LaravelIBMQ\LaravelIbmq
 */
class LaravelIBMQ extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Outhebox\LaravelIBMQ\LaravelIBMQ::class;
    }
}
