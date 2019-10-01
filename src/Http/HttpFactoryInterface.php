<?php

namespace V9\Response\Http;

use Illuminate\Contracts\Container\BindingResolutionException;
use V9\Response\Http\Json\JsonResponseInterface;

interface HttpFactoryInterface
{
    /**
     * @return JsonResponseInterface
     * @throws BindingResolutionException
     */
    public function json(): JsonResponseInterface;
}
