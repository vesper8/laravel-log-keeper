<?php namespace MathiasGrimm\LaravelLogKeeper;
/**
 * Created by PhpStorm.
 * User: Mathias Grimm <mathiasgrimm@gmail.com>
 * Date: 08/03/2016
 * Time: 12:22
 */
use Exception;
use Illuminate\Support\ServiceProvider as Provider;

class LaravelServiceProvider extends Provider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/laravel-log-keeper.php' => config_path('laravel-log-keeper.php'),
        ], 'config');

        $config = config('laravel-log-keeper');

        if ($config['enabled'] && !$config['disk']) {
            throw new Exception("disk not configured for Laravel Log Keeper");
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/laravel-log-keeper.php', 'laravel-log-keeper');
    }
}