<?php

namespace KenoKokoro\Response\Http;

use Illuminate\Contracts\Container\Container;
use KenoKokoro\Response\Http\Json\Factory;
use KenoKokoro\Response\Http\Json\JsonResponseInterface;

class HttpFactory implements HttpFactoryInterface
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function json(): JsonResponseInterface
    {
        return $this->container->make(Factory::class);
    }
}
