<?php namespace MathiasGrimm\LaravelLogKeeper\Repos\Fakes;

use Carbon\Carbon;
use Exception;
use Illuminate\Filesystem\Filesystem;
use MathiasGrimm\LaravelLogKeeper\Repos\LocalLogsRepoInterface;
use MathiasGrimm\LaravelLogKeeper\Support\LogUtil;

class FakeLocalLogsRepo implements LocalLogsRepoInterface
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
            '/fake/storage/logs/laravel-old-2010-01-01.log',
            '/fake/storage/logs/laravel-old-2010-01-02.log',

            "/fake/storage/logs/laravel-6days-{$_6Days->toDateString()}.log",
            "/fake/storage/logs/laravel-7days-{$_7Days->toDateString()}.log",
            "/fake/storage/logs/laravel-8days-{$_8Days->toDateString()}.log",

            "/fake/storage/logs/laravel-29days-{$_29Days->toDateString()}.log",
            "/fake/storage/logs/laravel-30days-{$_30Days->toDateString()}.log",
            "/fake/storage/logs/laravel-31days-{$_31Days->toDateString()}.log",
        ];
    }

    public function getLogs()
    {
        $logs = LogUtil::getLogs($this->logs);
        $logs = LogUtil::mapBasename($logs);

        return $logs;
    }

    public function getCompressed()
    {
        $logs = LogUtil::getCompressed($this->logs);
        $logs = LogUtil::mapBasename($logs);

        return $logs;
    }

    public function deleteLog($log)
    {
        $this->logs = array_filter($this->logs, function ($item) use ($log) {
            return "/fake/storage/logs/{$log}" !== $item;
        });
    }

    public function compress($log, $compressedName)
    {
        $this->logs[] = '/fake/storage/logs/' . $compressedName;
        $this->deleteLog($log);
    }

    public function get($log)
    {
        return 'dummy file content';
    }
}