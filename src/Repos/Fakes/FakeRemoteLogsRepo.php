<?php namespace MathiasGrimm\LaravelLogKeeper\Repos\Fakes;

use MathiasGrimm\LaravelLogKeeper\Repos\RemoteLogsRepoInterface;
use Carbon\Carbon;
use MathiasGrimm\LaravelLogKeeper\Support\LogUtil;

class FakeRemoteLogsRepo implements RemoteLogsRepoInterface
{
    private $config;
    private $logs;

    public function __construct(array $config)
    {
        $this->config = $config;

        $_6Days = Carbon::today()->subDays(6);
        $_7Days = Carbon::today()->subDays(7);
        $_8Days = Carbon::today()->subDays(8);

        $_29Days = Carbon::today()->subDays(29);
        $_30Days = Carbon::today()->subDays(30);
        $_31Days = Carbon::today()->subDays(31);

        $this->logs = [
            '/fake/storage/logs/laravel-old-2010-01-01.log.tar.bz2',
            '/fake/storage/logs/laravel-old-2010-01-02.log',

            "/fake/storage/logs/laravel-6days-{$_6Days->toDateString()}.log.tar.bz2",
            "/fake/storage/logs/laravel-7days-{$_7Days->toDateString()}.log.tar.bz2",
            "/fake/storage/logs/laravel-8days-{$_8Days->toDateString()}.log.tar.bz2",

            "/fake/storage/logs/laravel-29days-{$_29Days->toDateString()}.log.tar.bz2",
            "/fake/storage/logs/laravel-30days-{$_30Days->toDateString()}.log.tar.bz2",
            "/fake/storage/logs/laravel-31days-{$_31Days->toDateString()}.log.tar.bz2",
        ];
    }

    public function setLogs(array $logs)
    {
        $this->logs = $logs;
    }

    public function getLogs()
    {
        $logs       = LogUtil::getCompressed($this->logs);
        $logs       = LogUtil::mapBasename($logs);

        return $logs;
    }

    public function deleteLog($log)
    {
        $this->logs = array_filter($this->logs, function ($item) use ($log) {
            return "/fake/storage/logs/{$log}" !== $item;
        });
    }

    public function put($log, $content)
    {
        $this->logs[] = "/fake/storage/logs/{$log}";
    }
}