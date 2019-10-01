<?php

namespace KenoKokoro\Tests\Response\Unit\Http;

use V9\Response\Http\Json\JsonResponseInterface;
use V9\Response\Http\HttpFactoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Mockery as m;
use Mockery\MockInterface;
use V9\Response\Http\Json\Factory as JsonFactory;
use V9\Response\Http\HttpFactory;
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
