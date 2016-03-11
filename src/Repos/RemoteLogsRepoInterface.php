<?php namespace MathiasGrimm\LaravelLogKeeper\Repos;


interface RemoteLogsRepoInterface
{
    public function __construct(array $config);

    public function getLogs();

    public function deleteLog($log);

    public function put($log, $content);

}