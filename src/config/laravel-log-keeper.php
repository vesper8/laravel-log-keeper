<?php
/**
 * Created by PhpStorm.
 * User: Mathias Grimm <mathiasgrimm@gmail.com>
 * Date: 08/03/2016
 * Time: 12:09
 */

return [
    // ----------------------------------------------------------------------------
    // Enable or Disable the Laravel Log Keeper
    // ----------------------------------------------------------------------------
    'enabled' => env('LARAVEL_LOG_KEEPER_ENABLED', true),

    // ----------------------------------------------------------------------------
    // Where in the remote location it will be stored. You can leave it blank
    // ----------------------------------------------------------------------------
    'remote_path' => env('LARAVEL_LOG_KEEPER_REMOTE_PATH'),

    // ----------------------------------------------------------------------------
    // How many days a file will be kept on the local disk before
    // being uploaded to the remote storage
    // ----------------------------------------------------------------------------
    'localRetention' => env('LARAVEL_LOG_KEEPER_LOCAL_RETENTION_DAYS'  , 7),

    // ----------------------------------------------------------------------------
    // How many days a file will be kept on the remote for.
    // ----------------------------------------------------------------------------
    'remoteRetention' => env('LARAVEL_LOG_KEEPER_REMOTE_RETENTION_DAYS' , 30),

    // ----------------------------------------------------------------------------
    // Which config/filesystems.php disk will be used
    // ----------------------------------------------------------------------------
    'disk' => env('LARAVEL_LOG_KEEPER_DISK'),

    // ----------------------------------------------------------------------------
    // For the compression we use bzip which is not always present
    // ----------------------------------------------------------------------------
    'compressRemote' => env('LARAVEL_LOG_KEEPER_COMPRESS_REMOTE', true),
];
