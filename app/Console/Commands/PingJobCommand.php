<?php

namespace App\Console\Commands;


use App\Jobs\Microservice1\CreatedUserFromMicroservice1;
use Illuminate\Console\Command;

class PingJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ping:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [
            'name' => 'user',
            'email' => 'email@gmail.com',
            'password' => '1234',
        ];
        CreatedUserFromMicroservice1::dispatch($data)->onQueue('microservice2_queue');
    }
}
