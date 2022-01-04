<?php

declare(strict_types=1);

namespace Microservice\Common\Infrastructure;

use Geekshubs\RabbitMQ\MessageI;
use Geekshubs\RabbitMQ\RabbitMQ;
use PhpAmqpLib\Message\AMQPMessage;

class MessageObject implements MessageI
{

    public function Message(AMQPMessage $message): void
    {
        $object = json_decode($message->body, true);
        $queue_name = $object['fromQueue']; //Response to the queue origin

        /* Resolve class by routing_key*/
        $routingKey = $message->get('routing_key');
        $routingKeyInfo = explode(".", $routingKey);
        $className = $routingKeyInfo[(sizeOf($routingKeyInfo)) - 1];
        $className = "\\App\\IOClass\\$className";
        $class = app($className);
        $class->execute($object);

        $rabbitMq = new RabbitMQ(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', '5667'),
            env('RABBITMQ_USERNAME', 'rabbitmq'),
            env('RABBITMQ_PASSWORD', 'rabbitmq'),
            env('RABBITMQ_VHOST', '/')
        );
        $rabbitMq->createConnect($queue_name);
        $rabbitMq->responseRpc(['response' => '200'], $message);
    }
}
