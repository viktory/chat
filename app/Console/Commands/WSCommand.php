<?php

namespace App\Console\Commands;

use App\Chat;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WSCommand extends Command
{

    public $server;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wschat:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start web socket server';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting web socket server...');
        $this->server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8080,
            '0.0.0.0'
        );
        $this->info('To stop the web socket server press "Ctrl" + "C"');
        $this->server->run();
    }
}
