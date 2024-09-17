# Laravel IBMQ

<p align="center">
    <a href="#features">Features</a> |
    <a href="#requirements">Requirements</a> |
    <a href="#installation">Installation</a> |
    <a href="#usage">Usage</a> |
    <a href="#changelog">Changelog</a>
</p>

<p align="center">
<a href="https://packagist.org/packages/outhebox/laravel-ibmq"><img src="https://img.shields.io/packagist/v/outhebox/laravel-ibmq" alt="Latest Stable Version"></a>
<a href="https://github.com/MohmmedAshraf/laravel-ibmq/actions?query=workflow%3Arun-tests"><img src="https://github.com/MohmmedAshraf/laravel-ibmq/workflows/run-tests/badge.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/outhebox/laravel-ibmq"><img src="https://img.shields.io/packagist/dt/outhebox/laravel-ibmq" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/outhebox/laravel-ibmq"><img src="https://img.shields.io/packagist/php-v/outhebox/laravel-ibmq.svg" alt="PHP from Packagist"></a>
<a href="https://packagist.org/packages/outhebox/laravel-ibmq"><img src="https://img.shields.io/badge/Laravel-10.x-brightgreen.svg" alt="Laravel Version"></a>
</p>

A Laravel package to connect with IBM MQ, allowing for sending and receiving messages. This package supports multiple queues for inbound and outbound messages, with advanced error handling and logging.

## Features

- Easy-to-use API for interacting with IBM MQ.
- Separate queues for inbound and outbound messaging.
- Fluent API for sending and receiving messages.
- Configurable via environment variables.

## Requirements

- PHP 8.1+ with `ext-sockets` extension enabled
- Laravel 10 or higher
- IBM MQ instance

## Installation

You can install the package via composer:

```bash
composer require outhebox/laravel-ibmq
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-ibmq-config"
```

This is the contents of the published config file:

```php
return [
    'host' => env('IBM_MQ_HOST', 'your-host'),
    'port' => env('IBM_MQ_PORT', 1414),
    'queue_manager' => env('IBM_MQ_QUEUE_MANAGER', 'your-queue-manager'),
    'username' => env('IBM_MQ_USERNAME', null),
    'password' => env('IBM_MQ_PASSWORD', null),

    'queues' => [
        'inbound' => env('IBM_MQ_INBOUND_QUEUE', 'your-inbound-queue'),
        'outbound' => env('IBM_MQ_OUTBOUND_QUEUE', 'your-outbound-queue'),
    ],
];
```

## Usage

### Sending Messages

```php
use Outhebox\LaravelIBMQ\Facades\LaravelIBMQ;
use Outhebox\LaravelIBMQ\Exceptions\IBMQException;

$ibmQueue = new LaravelIBMQ();

try {
    $ibmQueue->sendMessage('Hello, IBM MQ!');
    echo "Message sent successfully!";
} catch (IBMQException $e) {
    echo "Failed to send message: " . $e->getMessage();
}
```

### Listening to Messages

```php
use Outhebox\LaravelIBMQ\Facades\LaravelIBMQ;
use Outhebox\LaravelIBMQ\Exceptions\IBMQException;

$ibmQueue = new LaravelIBMQ();

try {
    $ibmQueue->listenToMessages(function ($messageBody) {
        echo "Received message: " . $messageBody;
    });
} catch (IBMQException $e) {
    echo "Failed to receive messages: " . $e->getMessage();
}
```

## Closing Connections
Connections are automatically closed when the object is destroyed or the application ends. However, you can explicitly close the connection if needed:

```php
use Outhebox\LaravelIBMQ\Facades\LaravelIBMQ;

$ibmQueue = new LaravelIBMQ();

$ibmQueue->close();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohamed Ashraf](https://github.com/MohmmedAshraf)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
