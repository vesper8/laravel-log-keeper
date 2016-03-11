<?php

use MathiasGrimm\LaravelLogKeeper\Repos\Fakes\FakeRemoteLogsRepo;

class FakeRemoteLogsRepoTest extends TestCase
{
    private function getRepo()
    {
        $config = config('laravel-log-keeper');
        $repo   = new FakeRemoteLogsRepo($config);

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