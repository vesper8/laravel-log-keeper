<?php


use MathiasGrimm\LaravelLogKeeper\Repos\FakeLogsRepo;

class FakeRemoteLogsRepoTest extends TestCase
{
    private function getRepo()
    {
        $config = config('laravel-log-keeper');
        $repo   = new FakeLogsRepo($config);

        return $repo;
    }

    


}