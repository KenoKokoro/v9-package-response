<?php

namespace V9\Response\Http\Redirect;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\ResponseFactory;

class Factory implements RedirectResponseInterface
{
    const STATUS_SUCCESS = 'success';
    const STATUS_NEUTRAL = 'neutral';

    /**
     * @var UrlGenerator
     */
    private UrlGenerator $url;

    /**
     * @var ResponseFactory
     */
    private ResponseFactory $response;

    public function __construct(UrlGenerator $url, ResponseFactory $response)
    {
        $this->url = $url;
        $this->response = $response;
    }

    public function success(string $to = null, string $message = null, array $append = []): RedirectResponse
    {
        if (empty($message)) {
            $message = 'Successfully executed.';
        }

        return $this->redirect(self::STATUS_SUCCESS, $message, $to, $append);
    }

    public function simple(string $to = null, string $message = null, array $append = []): RedirectResponse
    {
        if (empty($message)) {
            $message = 'Successfully executed.';
        }

        return $this->redirect(self::STATUS_NEUTRAL, $message, $to, $append);
    }

    private function redirect(string $status, string $message, ?string $to = null, array $append = []): RedirectResponse
    {
        if ($to === null) {
            $to = $this->url->previous();
        }

        return $this->response->redirectTo($to)->with($this->buildFlashData($status, $message, $append));
    }

    private function buildFlashData(string $status, string $message, array $append = []): array
    {
        $flashData = ['status' => $status, 'message' => $message];

        return array_merge($flashData, $append);
    }
}