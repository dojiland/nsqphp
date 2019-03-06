<?php

namespace Per3evere\Nsq;

use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Support\ServiceProvider;
use Per3evere\Nsq\Console\NsqCommand;

class NsqServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the nsq services.
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

        // 注册命令
        if ($this->app->runningInConsole()) {
            $this->commands([
                NsqCommand::class
            ]);
        }
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
            $nsq = new nsqphp($lookup);

            // 发送到默认 nsqd 服务器
            $nsq->publishTo($config['nsqd_addrs']);

            return $nsq;
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