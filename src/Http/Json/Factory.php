<?php

namespace KenoKokoro\Response\Http\Json;

use Illuminate\Http\JsonResponse;

class Factory implements JsonResponseInterface
{
    const RESULT_GROUP = 'result';
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    public function build(int $status, array $append = []): JsonResponse
    {
        switch ($status) {
            case self::HTTP_OK:
                return $this->ok($append);
                break;
            case self::HTTP_CREATED:
                return $this->created($append);
                break;
            case self::HTTP_BAD_REQUEST:
                return $this->badRequest($append);
                break;
            case self::HTTP_UNAUTHORIZED:
                return $this->unauthorized($append);
                break;
            case self::HTTP_FORBIDDEN:
                return $this->forbidden($append);
                break;
            case self::HTTP_NOT_FOUND:
                return $this->notFound($append);
                break;
            case self::HTTP_METHOD_NOT_ALLOWED:
                return $this->notAllowed($append);
                break;
            case self::HTTP_UNPROCESSABLE_ENTITY:
                return $this->unprocessableEntity($append);
                break;
        }

        return $this->internalError($append);
    }

    public function ok(array $append = []): JsonResponse
    {
        return $this->instance('Ok.', $append, self::HTTP_OK);
    }

    public function created(array $append = []): JsonResponse
    {
        return $this->instance('Created.', $append, self::HTTP_CREATED);
    }

    public function badRequest(array $append = []): JsonResponse
    {
        return $this->instance('Bad Request.', $append, self::HTTP_BAD_REQUEST);
    }

    public function unauthorized(array $append = []): JsonResponse
    {
        return $this->instance('Unauthorized.', $append, self::HTTP_UNAUTHORIZED);
    }

    public function forbidden(array $append = []): JsonResponse
    {
        return $this->instance('Forbidden.', $append, self::HTTP_FORBIDDEN);
    }

    public function notFound(array $append = []): JsonResponse
    {
        return $this->instance('Not found.', $append, self::HTTP_NOT_FOUND);
    }

    public function notAllowed(array $append = []): JsonResponse
    {
        return $this->instance('Method not allowed.', $append, self::HTTP_METHOD_NOT_ALLOWED);
    }

    public function unprocessableEntity(array $append = []): JsonResponse
    {
        return $this->instance('Unprocessable Entity', $append, self::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function internalError(array $append = []): JsonResponse
    {
        return $this->instance('Internal error.', $append, self::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @param array  $data
     * @param int    $code
     * @return JsonResponse
     */
    private function instance(string $message, array $data, int $code): JsonResponse
    {
        $data['message'] = $data['message'] ?? $message;
        $data[self::RESULT_GROUP] = $data[self::RESULT_GROUP] ?? [];

        return new JsonResponse($data, $code);
    }
}
