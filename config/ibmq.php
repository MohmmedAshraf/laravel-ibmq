<?php

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
