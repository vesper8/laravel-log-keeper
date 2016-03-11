<?php namespace MathiasGrimm\LaravelLogKeeper\Repos;

use \Storage;
use MathiasGrimm\LaravelLogKeeper\Support\LogUtil;

class RemoteLogsRepo implements RemoteLogsRepoInterface
{
    private $config;
    private $localLogPath;
    private $disk;
    private $remotePath;

    public function __construct(array $config)
    {
        $this->config       = $config;
        $this->localLogPath = storage_path('logs');
        $this->disk         = Storage::disk($this->config['remote_disk']);
        $this->remotePath   = $this->config['remote_path'] ? $this->config['remote_path'] . '/' : null;
    }

    public function getLogs()
    {
        $allLogs    = $this->disk->files($this->remotePath);
        $logs       = LogUtil::getCompressed($allLogs);
        $logs       = LogUtil::mapBasename($logs);

        return $logs;
    }

    public function deleteLog($log)
    {
        $path = "{$this->remotePath}{$log}";

        $this->disk->delete($path);
    }

    public function put($log, $content)
    {
        $path = "{$this->remotePath}{$log}";

        $this->disk->put($path, $content);
    }
}