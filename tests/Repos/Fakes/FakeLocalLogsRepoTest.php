<?php

use MathiasGrimm\LaravelLogKeeper\Repos\Fakes\FakeLocalLogsRepo;

class FakeLocalLogsRepoTest extends TestCase
{
    private function getRepo()
    {
        $config = config('laravel-log-keeper');
        $repo   = new FakeLocalLogsRepo($config);

        return $repo;
    }

    /**
     * @test
     */
    public function it_get_logs()
    {
        $repo = $this->getRepo();

        $this->assertNotNull($repo->getLogs());
    }

    /**
     * @test
     */
    public function it_compresses()
    {
        $repo = $this->getRepo();
        $logs = $repo->getCompressed();

        $log        = 'laravel-2016-01-10.log';
        $compressed = $log . '.tar.bz2';

        $this->assertFalse(in_array($compressed , $logs));

        $repo->compress($log, $compressed);

        $logs = $repo->getCompressed();

        $this->assertTrue(in_array($compressed , $logs));
    }

    /**
     * @test
     */
    public function it_deletes()
    {
        $repo = $this->getRepo();
        $logs = $repo->getLogs();

        $log = $logs[0];
        $repo->deleteLog($log);

        $logs = $repo->getLogs();
        $this->assertFalse(in_array($log, $logs));
    }


}