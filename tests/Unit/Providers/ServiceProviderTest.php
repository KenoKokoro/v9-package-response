<?php

namespace KenoKokoro\Tests\Response\Unit\Providers;

use Illuminate\Contracts\Foundation\Application;
use V9\Response\Http\HttpFactory;
use V9\Response\Http\Json\Factory as JsonFactory;
use V9\Response\Http\Json\JsonResponseInterface;
use V9\Response\Http\HttpFactoryInterface;
use V9\Response\Providers\ServiceProvider;
use Mockery as m;
use Mockery\MockInterface;
use V9\API\V1\Tests\Unit\UnitTestCase;

class ServiceProviderTest extends UnitTestCase
{
    /**
     * @var MockInterface|Application
     */
    private MockInterface $application;

    private ServiceProvider $fixture;

    protected function setUp(): void
    {
        $this->application = m::mock(Application::class);
        $this->fixture = new ServiceProvider($this->application);
        parent::setUp();
    }

    /** @test */
    public function should_register_response_modules(): void
    {
        $this->application
            ->shouldReceive('bind')
            ->once()
            ->with(HttpFactoryInterface::class, HttpFactory::class);
        $this->application
            ->shouldReceive('bind')
            ->once()
            ->with(JsonResponseInterface::class, JsonFactory::class);

        $this->fixture->register();
    }
}
