<?php

namespace Digikraaft\Abokifx\Tests;

use Digikraaft\Abokifx\Exceptions\InvalidArgumentException;
use Digikraaft\Abokifx\Abokifx;
use Mockery as mk;
use PHPUnit\Framework\TestCase;

class Mock extends TestCase
{
    protected $abokifx;
    protected $mock;

    public function setUp(): void
    {
        TestHelper::setup();
        $this->abokifx = mk::mock('Digikraaft\Abokifx\Abokifx');
        $this->mock = mk::mock('GuzzleHttp\Client');
    }

    /** @test */
    public function it_returns_instance_of_mono_ng()
    {
        $this->assertInstanceOf("Digikraaft\Abokifx\Abokifx", $this->abokifx);
    }

    /** @test */
    public function it_returns_invalid_api_key()
    {
        $this->expectException(InvalidArgumentException::class);
        Mono::setSecretKey('');
    }

    /** @test */
    public function it_returns_api_key()
    {
        Mono::setSecretKey('sk_apikey');
        $this->assertIsString(Mono::getSecretKey());
    }
}
