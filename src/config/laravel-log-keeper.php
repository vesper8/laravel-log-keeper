<?php

return [
    // ----------------------------------------------------------------------------
    // Enable or Disable the Laravel Log Keeper
    // ----------------------------------------------------------------------------
    'enabled' => env('LARAVEL_LOG_KEEPER_ENABLED', true),

    // ----------------------------------------------------------------------------
    // Enable or Disable the Laravel Log Keeper for remote operations
    // ----------------------------------------------------------------------------
    'enabled_remote' => env('LARAVEL_LOG_KEEPER_ENABLED_REMOTE', true),

    // ----------------------------------------------------------------------------
    // Enable or Disable the Laravel Log Keeper for local operations
    // ----------------------------------------------------------------------------
    'enabled_local' => env('LARAVEL_LOG_KEEPER_ENABLED_REMOTE', true),

    // ----------------------------------------------------------------------------
    // Where in the remote location it will be stored. You can leave it blank
    // ----------------------------------------------------------------------------
    'remote_path' => rtrim(env('LARAVEL_LOG_KEEPER_REMOTE_PATH'), '/'),

    // ----------------------------------------------------------------------------
    // How many days a file will be kept on the local disk before
    // being uploaded to the remote storage
    // ----------------------------------------------------------------------------
    'localRetentionDays' => env('LARAVEL_LOG_KEEPER_LOCAL_RETENTION_DAYS'  , 7),

    // ----------------------------------------------------------------------------
    // How many days a file will be kept on the remote for.
    // ----------------------------------------------------------------------------
    'remoteRetentionDays' => env('LARAVEL_LOG_KEEPER_REMOTE_RETENTION_DAYS' , 30),

    // ----------------------------------------------------------------------------
    // Which config/filesystems.php disk will be used for remote disk
    // ----------------------------------------------------------------------------
    'remote_disk' => env('LARAVEL_LOG_KEEPER_REMOTE_DISK'),

    // ----------------------------------------------------------------------------
    // For the compression we use bzip which is not always present
    // ----------------------------------------------------------------------------
    'compressRemote' => env('LARAVEL_LOG_KEEPER_COMPRESS_REMOTE', true),
];
