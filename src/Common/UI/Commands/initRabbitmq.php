<?php

declare(strict_types=1);

namespace Microservice\Common\UI\Commands;


use Geekshubs\RabbitMQ\RabbitMQ;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Microservice\Common\UI\Services\InitRabbitmqQueues;

class initRabbitmq extends Command
{

    protected $signature = "rabbitmq:init";
    protected $descritpion = "Iniciando colas de RabbitMQ";

    public function handle()
    {
        $initRabbit = new InitRabbitmqQueues(env('SELF_QUEUE'));
        ($initRabbit)();
    }
}
