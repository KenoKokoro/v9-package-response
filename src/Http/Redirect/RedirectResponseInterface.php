<?php

namespace V9\Response\Http\Redirect;

use Illuminate\Http\RedirectResponse;

interface RedirectResponseInterface
{
    /**
     * @param string|null $to
     * @param string|null $message
     * @param array       $append
     * @return RedirectResponse
     */
    public function success(string $to = null, string $message = null, array $append = []): RedirectResponse;

    /**
     * @param string|null $to
     * @param string|null $message
     * @param array       $append
     * @return RedirectResponse
     */
    public function simple(string $to = null, string $message = null, array $append = []): RedirectResponse;
}