<?php

namespace KenoKokoro\Response\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use KenoKokoro\Response\Http\Json\Factory;
use KenoKokoro\Response\Http\Json\JsonResponseInterface;
use KenoKokoro\Response\Http\HttpFactory;
use KenoKokoro\Response\Http\HttpFactoryInterface;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HttpFactoryInterface::class, HttpFactory::class);
        $this->app->bind(JsonResponseInterface::class, Factory::class);
    }
}
