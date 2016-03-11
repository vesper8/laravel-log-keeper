<?php namespace MathiasGrimm\LaravelLogKeeper\Services;

use MathiasGrimm\LaravelLogKeeper\Repos\LocalLogsRepoInterface;
use MathiasGrimm\LaravelLogKeeper\Repos\RemoteLogsRepoInterface;
use Carbon\Carbon;
use MathiasGrimm\LaravelLogKeeper\Support\LogUtil;

class LogKeeperService
{
    private $config;
    private $localRepo;
    private $remoteRepo;
    private $localRetentionDays;
    private $remoteRetentionDays;

    /**
     * @var Carbon
     */
    private $today;

    public function __construct($config, LocalLogsRepoInterface $localRepo, RemoteLogsRepoInterface $remoteRepo)
    {
        $this->config              = $config;
        $this->localRepo           = $localRepo;
        $this->remoteRepo          = $remoteRepo;
        $this->today               = Carbon::today();
        $this->localRetentionDays  = $this->config['localRetentionDays'];
        $this->remoteRetentionDays = $this->config['remoteRetentionDays'];
    }

    public function work()
    {
        $this->localWork();
        $this->remoteCleanUp();
    }

    private function localWork()
    {
        $logs = $this->localRepo->getLogs();

        foreach ($logs as $log) {
            $logDate = LogUtil::getDate($log);
            $days    = $logDate->diffInDays($this->today);

            if (($days > $this->localRetentionDays) && ($days <= $this->remoteRetentionDays)) {
                $compressedName = "{$log}.tar.bz2";
                $this->localRepo->compress($log, $compressedName);
                $content = $this->localRepo->get($compressedName);
                $this->remoteRepo->put($compressedName, $content);
                $this->localRepo->deleteLog($compressedName);
            } elseif (($days > $this->localRetentionDays) && ($days > $this->remoteRetentionDays)) {
                // file too old to be stored either remotely or locally
                $this->localRepo->deleteLog($log);
            }
        }
    }

    private function remoteCleanUp()
    {
        $logs = $this->remoteRepo->getLogs();

        foreach ($logs as $log) {
            $logDate = LogUtil::getDate($log);
            $days    = $logDate->diffInDays($this->today);

            if ($days > $this->remoteRetentionDays) {
                $this->remoteRepo->deleteLog($log);
            }
        }
    }


}