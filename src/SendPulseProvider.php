<?php

namespace Rogertiweb\SendPulse;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Rogertiweb\SendPulse\SendPulseApi;
use Rogertiweb\SendPulse\Token\FileTokenStorage;
use Rogertiweb\SendPulse\Contracts\TokenStorage;
use Rogertiweb\SendPulse\Token\SessionTokenStorage;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Rogertiweb\SendPulse\Contracts\SendPulseApi as SendPulseApiContract;

class SendPulseProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/sendpulse.php' => config_path('sendpulse.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/sendpulse.php', 'sendpulse'
        );

        $this->registerStorageManager();

        $this->app->singleton(SendPulseApiContract::class, function ($app) {

            $config = $app['config']->get('sendpulse');

            return new SendPulseApi(
                $app['token.manager']->driver(),
                $config['api_user_id'],
                $config['api_secret']
            );
        });

        $this->app->alias(SendPulseApiContract::class, 'sendpulse');
    }

    /**
     * Register the storage driver manager
     */
    public function registerStorageManager()
    {
        $this->app->bind('token.manager', function ($app) {
            return new TokenStorageManager($app);
        });
    }
}
