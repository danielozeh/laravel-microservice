<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\RabbitMQQueue;

class ListenRabbitMQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for RabbitMQ messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Listening for RabbitMQ messages...');

        $connection = config('queue.connections.rabbitmq.connection');
        $queue = config('queue.connections.rabbitmq.queue');

        $this->info("Using connection: $connection, queue: $queue");

        $queue = new RabbitMQQueue(app(), config('queue.connections.rabbitmq'));

        // while (true) {
        //     $queue->pop($queue->getQueue(null), null, null, function ($job, $message) {
        //         $this->info('Received message: ' . $message->getBody());
        //         $job->delete();
        //     });

        //     sleep(1); // Adjust sleep time as needed
        // }
    }
}
