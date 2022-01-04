<?php

declare(strict_types=1);

namespace Microservice\Common\UI\Commands;

use Illuminate\Console\Command;
use Microservice\Common\UI\Services\SendMessageRabbitmqQueues;


class sendMessageRpc extends Command
{

    protected $signature = "rabbitmq:sendRPC";
    protected $descritpion = "Iniciando colas de RabbitMQ";


    public function handle()
    {
        $metadata = ['message' => "hola mundo"];

        $sendMessage = new SendMessageRabbitmqQueues(env('CONSUMER_QUEUE'), 'CreateLog', $metadata);
        ($sendMessage)();
    }
}
