<?php

use MathiasGrimm\LaravelLogKeeper\Repos\Fakes\FakeLocalLogsRepo;
use MathiasGrimm\LaravelLogKeeper\Repos\Fakes\FakeRemoteLogsRepo;
use MathiasGrimm\LaravelLogKeeper\Services\LogKeeperService;
use MathiasGrimm\LaravelLogKeeper\Support\LogUtil;
use Carbon\Carbon;

class LogKeeperServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_no_local_files_older_than_the_local_retention()
    {
        $today      = Carbon::today();
        $config     = config('laravel-log-keeper');
        $localRepo  = new FakeLocalLogsRepo($config);
        $remoteRepo = new FakeRemoteLogsRepo($config);
        $remoteRepo->setLogs([]);

        $service = new LogKeeperService($config, $localRepo, $remoteRepo);
        $service->work();

        $logs = $localRepo->getLogs();
        foreach ($logs as $log) {
            $date = LogUtil::getDate($log);
            $this->assertTrue($today->diffInDays($date) <= $config['localRetentionDays']);
        }
    }

    /**
     * @test
     */
    public function it_has_no_local_compressed_files()
    {
        $config     = config('laravel-log-keeper');
        $localRepo  = new FakeLocalLogsRepo($config);
        $remoteRepo = new FakeRemoteLogsRepo($config);
        $remoteRepo->setLogs([]);

        $service = new LogKeeperService($config, $localRepo, $remoteRepo);
        $service->work();

        $logs = $localRepo->getLogs();

        foreach ($logs as $log) {
            $this->assertFalse((bool) preg_match('/\.tar\.bz2$/', $log), $log);
        }
    }

    /**
     * @test
     */
    public function it_has_no_remote_files_newer_than_the_local_retention()
    {
        $today      = Carbon::today();
        $config     = config('laravel-log-keeper');
        $localRepo  = new FakeLocalLogsRepo($config);
        $remoteRepo = new FakeRemoteLogsRepo($config);
        $remoteRepo->setLogs([]);

        $service = new LogKeeperService($config, $localRepo, $remoteRepo);
        $service->work();

        $logs = $remoteRepo->getLogs();

        foreach ($logs as $log) {
            $date = LogUtil::getDate($log);
            $diff = $today->diffInDays($date);
            $this->assertTrue($diff > $config['localRetentionDays'], "Diff: {$diff} days Log: $log");
        }
    }

    /**
     * @test
     */
    public function it_has_no_remote_files_older_than_the_remote_retention()
    {
        $today      = Carbon::today();
        $config     = config('laravel-log-keeper');
        $localRepo  = new FakeLocalLogsRepo($config);
        $remoteRepo = new FakeRemoteLogsRepo($config);
        $remoteRepo->setLogs([]);

        $service = new LogKeeperService($config, $localRepo, $remoteRepo);
        $service->work();

        $logs = $remoteRepo->getLogs();

        foreach ($logs as $log) {
            $date = LogUtil::getDate($log);
            $diff = $today->diffInDays($date);
            $this->assertTrue($diff <= $config['remoteRetentionDays'], "Diff: {$diff} days Log: $log");
        }
    }
}