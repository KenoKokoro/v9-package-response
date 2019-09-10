<?php

namespace KenoKokoro\Response\Http;

use Illuminate\Contracts\Container\BindingResolutionException;
use KenoKokoro\Response\Http\Json\JsonResponseInterface;

interface HttpFactoryInterface
{
    /**
     * @return JsonResponseInterface
     * @throws BindingResolutionException
     */
    public function json(): JsonResponseInterface;
}
