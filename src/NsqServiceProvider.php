<?php

namespace Per3evere\Nsq;

use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Support\ServiceProvider;

class NsqServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__ . '/../config/nsq.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('nsq.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('nsq');
        }

        $this->mergeConfigFrom($source, 'nsq');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('nsq', function ($app) {
            $config = $app->make('config')->get('nsq');

            $lookup = new Lookup\Nsqlookupd($config['nsqlookupd_addrs']);

            return new nsqphp($lookup);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['nsq'];
    }
}