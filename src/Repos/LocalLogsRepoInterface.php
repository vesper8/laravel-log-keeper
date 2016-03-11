<?php namespace MathiasGrimm\LaravelLogKeeper\Repos;


interface LocalLogsRepoInterface
{
    public function __construct(array $config);

    public function getLogs();

    public function getCompressed();

    public function deleteLog($log);

    public function compress($log, $compressedName);

    public function get($log);
}