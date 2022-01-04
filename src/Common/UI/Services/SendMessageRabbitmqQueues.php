<?php

declare(strict_types=1);

namespace Microservice\Common\UI\Services;

use Geekshubs\RabbitMQ\RabbitMQ;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;



class SendMessageRabbitmqQueues
{
    private string $queueName;
    private string $method;
    private array $metadata;

    public function __construct(
        string $queueName,
        string $method,
        array $metadata
    ) {
        $this->queueName = $queueName;
        $this->method = $method;
        $this->metadata = $metadata;
    }
    public function __invoke()
    {
        $selfQueue = env('SELF_QUEUE');
        $this->metadata['fromQueue'] = $selfQueue;

        $rabbitMQ = new RabbitMQ(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', '5667'),
            env('RABBITMQ_USERNAME', 'rabbitmq'),
            env('RABBITMQ_PASSWORD', 'rabbitmq'),
            env('RABBITMQ_VHOST', '/')
        );
        $rabbitMQ->createConnect("$this->queueName");
        $rabbitMQ->createExchange("$this->queueName.command.message", "topic", null, true, null, null, null, null);
        $id = Str::uuid()->toString();
        log::info("sending ->" . json_encode($this->metadata));

        $result = $rabbitMQ->requestRpc($id, "$this->queueName", $this->queueName . "_return", "$this->queueName.command.message", $this->queueName . "." . $this->method, json_encode($this->metadata));
        //log::info("Contestación ->" . $result);
    }
}
