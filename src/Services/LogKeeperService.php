<?php namespace MathiasGrimm\LaravelLogKeeper\Services;

use Exception;
use MathiasGrimm\LaravelLogKeeper\Repos\LocalLogsRepoInterface;
use MathiasGrimm\LaravelLogKeeper\Repos\LogsRepoInterface;
use Carbon\Carbon;
use MathiasGrimm\LaravelLogKeeper\Support\LogUtil;

class LogKeeperService
{
    private $config;
    private $localRepo;
    private $remoteRepo;
    private $localRetentionDays;
    private $remoteRetentionDays;
    private $remoteRetentionDaysCalculated;

    /**
     * @var Carbon
     */
    private $today;

    public function __construct($config, LogsRepoInterface $localRepo, LogsRepoInterface $remoteRepo)
    {
        $this->config                        = $config;
        $this->localRepo                     = $localRepo;
        $this->remoteRepo                    = $remoteRepo;
        $this->today                         = Carbon::today();
        $this->localRetentionDays            = $this->config['localRetentionDays'];
        $this->remoteRetentionDays           = $this->config['remoteRetentionDays'];
        $this->remoteRetentionDaysCalculated = $this->config['remoteRetentionDaysCalculated'];
    }

    public function work()
    {
        if (!$this->config['enabled']) {
            return;
        }

        $this->localWork();

        if ($this->config['enabled_remote']) {
            $this->remoteCleanUp();
        }
    }

    private function localWork()
    {
        $logs = $this->localRepo->getLogs();

        foreach ($logs as $log) {
            $days = LogUtil::diffInDays($log, $this->today);

            if (($days > $this->localRetentionDays) && ($days <= $this->remoteRetentionDaysCalculated)) {
                $compressedName = "{$log}.tar.bz2";
                $this->localRepo->compress($log, $compressedName);
                $content = $this->localRepo->get($compressedName);

                if ($this->config['enabled_remote']) {
                    $this->remoteRepo->put($compressedName, $content);
                }

                $this->localRepo->delete($compressedName);
            } elseif (($days > $this->localRetentionDays) && ($days > $this->remoteRetentionDaysCalculated)) {
                // file too old to be stored either remotely or locally
                $this->localRepo->delete($log);
            }
        }
    }

    private function remoteCleanUp()
    {
        $logs = $this->remoteRepo->getCompressed();

        foreach ($logs as $log) {
            $days = LogUtil::diffInDays($log, $this->today);

            if ($days > $this->remoteRetentionDaysCalculated) {
                $this->remoteRepo->delete($log);
            }
        }
    }
}
