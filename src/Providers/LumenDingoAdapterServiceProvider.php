<?php

namespace Zeek\LumenDingoAdapter\Providers;

use Dingo\Api\Provider\LumenServiceProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Cookie\QueueingFactory;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\ServiceProvider;

class LumenDingoAdapterServiceProvider extends ServiceProvider
{
    /**
     * Boot the application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {

        $this->configure('auth');
        $this->configure('session');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // Session provider
        $this->registerCookieComponent();
        $this->registerIlluminateSession();


        // JWTAuth
        $this->app->register(LumenJWTServiceProvider::class);

        // Dingo
        $this->app->register(LumenServiceProvider::class);

        // Configure our JWT for Dingo
        $this->app->register(DingoJWTDriverServiceProvider::class);
    }

    /**
     * Register the illuminate service provider if it is not registered.
     *
     * @return void
     */
    protected function registerIlluminateSession()
    {
        if (!isset($this->app['session.store'])) {
            if (!$this->app['config']->has('session.driver')) {
                $this->app['config']->set('session.driver', 'file');
            }
            $this->app->register(SessionServiceProvider::class);
        }
    }

    protected function registerCookieComponent()
    {
        $app = $this->app;
        $this->app->singleton('cookie', function () use ($app) {
            return $app->loadComponent('session', CookieServiceProvider::class, 'cookie');
        });

        $this->app->bind(QueueingFactory::class, 'cookie');
    }

    /**
     * Configure provider.
     *
     * @param string $name
     *
     * @return void
     * @throws BindingResolutionException
     */
    protected function configure($name)
    {
        $path = sprintf('%s%s', $this->app->basePath(), "config/{$name}.php");

        if (!is_readable($path)) {
            $path = dirname(__DIR__) . "/config/{$name}.php";
        }

        $this->app->make('config')->set($name, require $path);
    }
}
