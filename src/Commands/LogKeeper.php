<?php namespace MathiasGrimm\LaravelLogKeeper\Commands;

use Illuminate\Console\Command;
use MathiasGrimm\LaravelLogKeeper\Factories\LogKeeperServiceFactory;

class LogKeeper extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laravel-log-keeper';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload local logs, delete old logs both locally and remote';

    private $config;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $service = LogKeeperServiceFactory::buildFromLaravelConfig();
        $service->work();
    }
}