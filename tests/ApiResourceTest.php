<?php

namespace Digikraaft\Abokifx\Tests;

use Digikraaft\Abokifx\ApiResource;
use Mockery as mk;
use PHPUnit\Framework\TestCase;

class ApiResourceTest extends TestCase
{
    protected $mock;

    public function setUp(): void
    {
        $this->mock = mk::mock('GuzzleHttp\Client');
    }

    /** @test  * */
    public function it_returns_endpoint_url()
    {
        $url = ApiResource::endPointUrl('movement');
        $this->assertIsString($url);
    }

    /** @test  * */
    public function it_returns_class_url()
    {
        $url = ApiResource::classUrl();
        $this->assertIsString($url);
    }

    /** @test  * */
    public function it_returns_base_url()
    {
        $url = ApiResource::baseUrl();
        $this->assertIsString($url);
    }
}
