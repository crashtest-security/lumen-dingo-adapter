<?php

namespace Zeek\LumenDingoAdapter\Providers;

use Dingo\Api\Auth\Auth;
use Dingo\Api\Auth\Provider\JWT;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Tymon\JWTAuth\JWTAuth;

class DingoJWTDriverServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function register()
    {
        $this->app->make(Auth::class)->extend('jwt', function ($app) {
            return new JWT($app->make(JWTAuth::class));
        });
    }
}
