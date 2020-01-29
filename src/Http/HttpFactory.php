<?php

namespace V9\Response\Http;

use Illuminate\Contracts\Container\Container;
use V9\Response\Http\Json\Factory as JsonFactory;
use V9\Response\Http\Json\JsonResponseInterface;
use V9\Response\Http\Redirect\Factory as RedirectFactory;
use V9\Response\Http\Redirect\RedirectResponseInterface;

class HttpFactory implements HttpFactoryInterface
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function json(): JsonResponseInterface
    {
        return $this->container->make(JsonFactory::class);
    }

    public function redirect(): RedirectResponseInterface
    {
        return $this->container->make(RedirectFactory::class);
    }
}
