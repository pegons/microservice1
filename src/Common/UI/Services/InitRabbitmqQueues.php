<?php

declare(strict_types=1);

namespace Microservice\Common\UI\Services;


use Geekshubs\RabbitMQ\Connection;
use Geekshubs\RabbitMQ\Consumer;
use Geekshubs\RabbitMQ\RabbitMQ;
use Illuminate\Support\Facades\Log;
use Microservice\Common\Infrastructure\MessageObject;


class InitRabbitmqQueues
{
    private string $queueName;

    public function __construct(
        string $queueName
    ) {
        $this->queueName = $queueName;
    }
    public function __invoke()
    {

        $rabbitMQ = new RabbitMQ(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', '5667'),
            env('RABBITMQ_USERNAME', 'rabbitmq'),
            env('RABBITMQ_PASSWORD', 'rabbitmq'),
            env('RABBITMQ_VHOST', '/')
        );

        $rabbitMQ->createConnect($this->queueName);

        $rabbitMQ->createExchange("$this->queueName.command.message", "topic", null, true, null, null, null, null);

        log::info("Iniciando Worker de escucha");

        try {
            $message = new MessageObject();
            $connection = new Connection(
                env('RABBITMQ_HOST', 'localhost'),
                env('RABBITMQ_PORT', '5667'),
                env('RABBITMQ_USERNAME', 'rabbitmq'),
                env('RABBITMQ_PASSWORD', 'rabbitmq'),
                env('RABBITMQ_VHOST', '/')
            );

            $connection->connect($this->queueName);
            $consume = new Consumer($connection, $message);

            $consume(
                $this->queueName,
                "$this->queueName.command.message",
                "$this->queueName.*"
            );
        } catch (\Exception $ex) {
            log::error("Error en la escucha " . $ex->getMessage() . "in file " . $ex->getFile() . " line : " . $ex->getLine());
        }
    }
}
