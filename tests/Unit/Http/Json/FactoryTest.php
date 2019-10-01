<?php

namespace V9\Tests\Response\Unit\Http\Json;

use Illuminate\Http\JsonResponse;
use V9\Response\Http\Json\Factory as JsonFactory;
use V9\Response\Http\Json\JsonResponseInterface;
use V9\Tests\Response\Unit\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @var JsonFactory
     */
    private JsonFactory $fixture;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fixture = new JsonFactory;
    }

    /** @test */
    public function should_create_json_response_factory_instance(): void
    {
        self::assertInstanceOf(JsonFactory::class, $this->fixture);
        self::assertInstanceOf(JsonResponseInterface::class, $this->fixture);
    }

    /** @test
     * @param int $status
     * @dataProvider responseCodes
     */
    public function should_create_json_response_instance_from_status(int $status): void
    {
        $actual = $this->fixture->build($status);
        self::assertInstanceOf(JsonResponse::class, $actual);
        self::assertEquals($status, $actual->getStatusCode());
    }

    /** @test */
    public function should_create_default_internal_error_json_response_instance(): void
    {
        $status = 503;
        $actual = $this->fixture->build($status);
        self::assertInstanceOf(JsonResponse::class, $actual);
        self::assertEquals(500, $actual->getStatusCode());
    }

    public function responseCodes(): array
    {
        return [
            [200],
            [201],
            [400],
            [401],
            [403],
            [404],
            [405],
            [422],
            [500],
        ];
    }
}
