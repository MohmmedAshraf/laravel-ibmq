<?php

namespace Outhebox\LaravelIBMQ;

use Exception;
use Illuminate\Support\Facades\Log;
use Outhebox\LaravelIBMQ\Exceptions\IBMQException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class LaravelIBMQ
{
    private readonly AMQPStreamConnection $connection;

    private $channel;

    /**
     * @throws \Outhebox\LaravelIBMQ\Exceptions\IBMQException
     */
    public function __construct()
    {
        $this->connection = $this->connect();
    }

    /**
     * @throws \Outhebox\LaravelIBMQ\Exceptions\IBMQException
     */
    private function connect(): AMQPStreamConnection
    {
        $host = config('ibmq.host');
        $port = config('ibmq.port');
        $username = config('ibmq.username');
        $password = config('ibmq.password');
        $queueManager = config('ibmq.queue_manager');

        try {
            $connection = new AMQPStreamConnection($host, $port, $username, $password, $queueManager);
            $this->channel = $connection->channel();

            return $connection;
        } catch (Exception $e) {
            throw IBMQException::connectionFailed($e->getMessage());
        }
    }

    /**
     * @throws \Outhebox\LaravelIBMQ\Exceptions\IBMQException
     */
    public function sendMessage(string $messageBody, array $properties = [], ?string $queueName = null): bool
    {
        $queue = $queueName ?? config('ibmq.queues.outbound');
        $msg = new AMQPMessage($messageBody, $properties);

        try {
            $this->channel->basic_publish($msg, '', $queue);

            return true;
        } catch (Exception $e) {
            throw IBMQException::messageSendFailed($e->getMessage());
        }
    }

    /**
     * @throws \Outhebox\LaravelIBMQ\Exceptions\IBMQException
     */
    public function listenToMessages(callable $callback, ?string $queueName = null, bool $autoAck = true): void
    {
        $queue = $queueName ?? config('ibmq.queues.inbound');

        try {
            $this->channel->basic_consume(
                $queue,
                '',
                false,
                $autoAck,
                false,
                false,
                function ($msg) use ($callback) {
                    $callback($msg->body);
                }
            );

            while ($this->channel->is_consuming()) {
                $this->channel->wait();
            }
        } catch (Exception $e) {
            throw IBMQException::messageReceiveFailed($e->getMessage());
        }
    }

    public function close(): void
    {
        try {
            $this->channel->close();
            $this->connection->close();
        } catch (Exception $e) {
            Log::error('IBM MQ Close Connection Error: '.$e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
