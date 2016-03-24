<?php namespace MathiasGrimm\LaravelLogKeeper\Factories;

use MathiasGrimm\LaravelLogKeeper\Repos\LocalLogsRepo;
use MathiasGrimm\LaravelLogKeeper\Repos\RemoteLogsRepo;
use MathiasGrimm\LaravelLogKeeper\Services\LogKeeperService;
use Monolog\Handler\NullHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LogKeeperServiceFactory
{
    /**
     * @param array $config
     * @return LogKeeperService
     */
    public static function buildFromConfig(array $config)
    {
        $logger = new Logger('laravel-log-keeper');

        if ($config['log']) {
            $logger->pushHandler(new RotatingFileHandler(storage_path('logs') . '/laravellogkeeper.log', 365, Logger::INFO));
        } else {
            $logger->pushHandler(new NullHandler());
        }

        $localRepo  = new LocalLogsRepo($config);
        $remoteRepo = new RemoteLogsRepo($config);
        $service    = new LogKeeperService($config, $localRepo, $remoteRepo, $logger);

        return $service;
    }

    public static function buildFromLaravelConfig()
    {
        $config = config('laravel-log-keeper');
        return static::buildFromConfig($config);
    }
}