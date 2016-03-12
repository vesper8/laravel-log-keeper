<?php namespace MathiasGrimm\LaravelLogKeeper\Factories;

use MathiasGrimm\LaravelLogKeeper\Repos\LocalLogsRepo;
use MathiasGrimm\LaravelLogKeeper\Repos\RemoteLogsRepo;
use MathiasGrimm\LaravelLogKeeper\Services\LogKeeperService;

class LogKeeperServiceFactory
{
    /**
     * @param array $config
     * @return LogKeeperService
     */
    public static function buildFromConfig(array $config)
    {
        $localRepo  = new LocalLogsRepo($config);
        $remoteRepo = new RemoteLogsRepo($config);
        $service    = new LogKeeperService($config, $localRepo, $remoteRepo);

        return $service;
    }

    public static function buildFromLaravelConfig()
    {
        $config = config('laravel-log-keeper');
        return static::buildFromConfig($config);
    }
}