<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class MessageBrokerListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broker:listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to messages from message broker';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $connection = config('queue.connections.rabbitmq.connection');
        $queue = config('queue.connections.rabbitmq.queue');

        // $channel = app('queue')->connection($connection)->getChannel();

        $connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), env('RABBITMQ_PORT'), env('RABBITMQ_USER'), env('RABBITMQ_PASSWORD'), env('RABBITMQ_VHOST'));
        $channel = $connection->channel();

        // $channel->queue_declare('my_queue', false, true, false, false);

        $channel->basic_consume($queue, '', false, true, false, false, function ($message) {
            // Process the message
            Log::info('Received message: ' . $message->body);
        });

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }
}
