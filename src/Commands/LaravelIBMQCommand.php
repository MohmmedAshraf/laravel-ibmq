<?php

namespace Outhebox\LaravelIBMQ\Commands;

use Illuminate\Console\Command;

class LaravelIBMQCommand extends Command
{
    public $signature = 'laravel-ibmq';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
