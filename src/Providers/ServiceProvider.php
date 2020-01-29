<?php

namespace V9\Response\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use V9\Response\Http\HttpFactory;
use V9\Response\Http\HttpFactoryInterface;
use V9\Response\Http\Json\Factory as JsonFactory;
use V9\Response\Http\Json\JsonResponseInterface;
use V9\Response\Http\Redirect\Factory as RedirectFactory;
use V9\Response\Http\Redirect\RedirectResponseInterface;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HttpFactoryInterface::class, HttpFactory::class);
        $this->app->bind(JsonResponseInterface::class, JsonFactory::class);
        $this->app->bind(RedirectResponseInterface::class, RedirectFactory::class);
    }
}
