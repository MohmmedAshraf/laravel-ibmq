<?php

namespace Outhebox\LaravelIBMQ\Exceptions;

use Exception;

class IBMQException extends Exception
{
    public static function connectionFailed(string $message): static
    {
        return new static("IBM MQ Connection Failed: $message");
    }

    public static function messageSendFailed(string $message): static
    {
        return new static("Failed to send message: $message");
    }

    public static function messageReceiveFailed(string $message): static
    {
        return new static("Failed to receive message: $message");
    }
}
