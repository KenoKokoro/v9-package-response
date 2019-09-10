<?php

namespace KenoKokoro\Tests\Response\Unit\Http;

use KenoKokoro\Response\Http\Json\JsonResponseInterface;
use KenoKokoro\Response\Http\HttpFactoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Mockery as m;
use Mockery\MockInterface;
use KenoKokoro\Response\Http\Json\Factory as JsonFactory;
use KenoKokoro\Response\Http\HttpFactory;
use V9\API\V1\Tests\Unit\UnitTestCase;

class HttpFactoryTest extends UnitTestCase
{
    /**
     * @var MockInterface|Container
     */
    private MockInterface $container;

    private HttpFactory $fixture;

    protected function setUp(): void
    {
        $this->container = m::mock(Container::class);
        $this->fixture = new HttpFactory($this->container);
        parent::setUp();
    }

    /** @test */
    public function should_create_response_factory_instance(): void
    {
        self::assertInstanceOf(HttpFactory::class, $this->fixture);
        self::assertInstanceOf(HttpFactoryInterface::class, $this->fixture);
    }

    /** @test
     * @throws BindingResolutionException
     */
    public function should_return_json_response_instance(): void
    {
        $instance = m::mock(JsonResponseInterface::class);

        $this->container
            ->shouldReceive('make')
            ->once()
            ->with(JsonFactory::class)
            ->andReturn($instance);

        $actual = $this->fixture->json();
        self::assertInstanceOf(JsonResponseInterface::class, $actual);
    }
}
