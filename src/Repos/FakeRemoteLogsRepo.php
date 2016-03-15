<?php namespace MathiasGrimm\LaravelLogKeeper\Repos;

use Carbon\Carbon;
use MathiasGrimm\LaravelLogKeeper\Support\LogUtil;

class FakeRemoteLogsRepo extends FakeLogsRepo
{
    private $config;
    private $logs;

    public function __construct(array $config)
    {
        parent::__construct($config);

        if ($this->config['enabled_remote'] && !$this->config['remote_disk']) {
            throw new Exception("remote_disk not configured for Laravel Log Keeper");
        }
    }
}