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
    MathiasGrimm\LaravelLogKeeper\LaravelServiceProvider::class,
    ...
],
```

#### Publish configuration file

```
php artisan vendor:publish --provider="MathiasGrimm\LaravelLogKeeper\LaravelServiceProvider" --tag="config"
```

### Lumen

Manually copy the configuration file
```
vendor/mathiasgrimm/laravel-log-keeper/src/config/laravel-log-keeper.php
```

to

```
config/laravel-log-keeper.php
```

Register Service Provider in `bootstrap/app.php`:

```php
...
$app->register(MathiasGrimm\LaravelLogKeeper\LumenServiceProvider::class);
...
```

Load configuration file in `bootstrap/app.php`:
```php
$app->configure('laravel-log-keeper');
```

## Security

If you discover any security related issues, please email mathiasgrimm@gmail.com instead of using the issue tracker.

## Credits

- [Mathias Grimm](https://github.com/mathiasgrimm)

