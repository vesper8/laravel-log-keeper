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
    protected $description = '????????????????????';

    private $config;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $this->config = config('laravel-log-keeper');
//
//        if (!$this->config['enabled']) {
//            $this->comment("Laravel Log Keeper is disabled");
//            return;
//        }

        $service = LogKeeperServiceFactory::buildFromLaravelConfig();
        $service->work();
    }
}