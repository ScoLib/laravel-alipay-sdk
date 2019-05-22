<?php

namespace Sco\LaravelAlipaySdk;

use Alipay\AopClient;
use Alipay\Key\AlipayKeyPair;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/alipaysdk.php' => config_path('alipaysdk.php'),
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/alipaysdk.php', 'alipaysdk');

        $this->app->singleton(AopClient::class, function () {
            $config = config('alipaysdk');
            $keyPair = AlipayKeyPair::create(
                $config['app_priv_key'],
                $config['alipay_pub_key']
            );
            $aop = new AopClient($config['app_id'], $keyPair);

            return $aop;
        });

        $this->app->alias(AopClient::class, 'aop-client');
    }
}
