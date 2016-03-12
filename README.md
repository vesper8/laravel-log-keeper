Laravel Log Keeper
======

[![Author](http://img.shields.io/badge/author-@matgrimm-blue.svg?style=flat-square)](https://twitter.com/matgrimm)
[![Latest Version](https://img.shields.io/github/release/mathiasgrimm/laravel-log-keeper.svg?style=flat-square)](https://github.com/mathiasgrimm/laravel-log-keeper/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/mathiasgrimm/laravel-log-keeper.svg?style=flat-square)](https://packagist.org/packages/mathiasgrimm/laravel-log-keeper)

Laravel Log Keeper helps rotating you logs while storing them anywhere you want with custom local/remote retention policies.

### Highlights

- Have full control of where/when/how you archive you logs
- Prevent your server from running out of space
- Custom retention policies for Local and Remote archiving

## Installation

Laravel Log Keeper is available via Composer:

```json
{
    "require": {
        "mathiasgrimm/laravel-log-keeper": "1.*"
    }
}
```

## Setup

### Laravel

#### Register Service Provider

```php
// config/app.php

'providers' => [
    ...
    MathiasGrimm\LaravelLogKeeper\Providers\LaravelServiceProvider::class,
    ...
],
```

Register Service Provider in `bootstrap/app.php`:

```php
...
$app->register(MathiasGrimm\LaravelLogKeeper\Providers\LumenServiceProvider::class);
...
```

Load configuration file in `bootstrap/app.php`:
```php
$app->configure('laravel-log-keeper');
```

### Log Format
To use the Laravel Log Keeper your log files have to be in the daily format, which is defined in your `config/app.php`
```php
    ...
    'log' => 'daily',
    ...
```

### Environment
```php
    // ----------------------------------------------------------------------------
    // Enable or Disable the Laravel Log Keeper
    // ----------------------------------------------------------------------------
    'enabled' => env('LARAVEL_LOG_KEEPER_ENABLED', true),

    // ----------------------------------------------------------------------------
    // Enable or Disable the Laravel Log Keeper for remote operations
    // ----------------------------------------------------------------------------
    'enabled_remote' => env('LARAVEL_LOG_KEEPER_ENABLED_REMOTE', true),

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
];
```

## Security

If you discover any security related issues, please email mathiasgrimm@gmail.com instead of using the issue tracker.

## Credits

- [Mathias Grimm](https://github.com/mathiasgrimm)

