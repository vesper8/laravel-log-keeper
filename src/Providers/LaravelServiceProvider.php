<?php namespace MathiasGrimm\LaravelLogKeeper\Providers;

use Exception;
use Illuminate\Support\ServiceProvider as Provider;

class LaravelServiceProvider extends Provider
{
    public function boot()
    {
//        $this->publishes([
//            __DIR__ . '/../config/laravel-log-keeper.php' => config_path('laravel-log-keeper.php'),
//        ], 'config');

        $config = config('laravel-log-keeper');

        if ($config['enabled']) {
            if ($config['enabled_remote'] && !$config['remote_disk']) {
                throw new Exception("disk not configured for Laravel Log Keeper");
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-log-keeper.php', 'laravel-log-keeper');

        $this->app->singleton('command.laravel-log-keeper', function ($app) {
            return $app['MathiasGrimm\LaravelLogKeeper\Commands\LogKeeper'];
        });

        $this->commands('command.laravel-log-keeper');
    }
}