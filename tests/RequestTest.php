<?php

namespace Digikraaft\Abokifx\Tests;

use Digikraaft\Abokifx\ApiOperations\Request;
use Digikraaft\Abokifx\Exceptions\ApiErrorException;
use Digikraaft\Abokifx\Exceptions\InvalidArgumentException;
use Digikraaft\Abokifx\Exceptions\IsNullException;
use Digikraaft\Abokifx\Rate;
use Mockery as mk;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function setUp(): void
    {
        TestHelper::setup();
    }

    /** @test */
    public function it_can_return_exception_when_params_is_empty_array_and_required()
    {
        $this->expectException(InvalidArgumentException::class);
        Request::validateParams([], true);
    }

    /** @test */
    public function it_can_return_exception_when_params_is_not_array_and_required()
    {
        $this->expectException(InvalidArgumentException::class);
        Request::validateParams('string', true);
    }

    /** @test */
    public function it_can_return_exception_when_params_is_not_array_and_not_required()
    {
        $this->expectException(InvalidArgumentException::class);
        Request::validateParams('string');
    }

    /** @test */
    public function it_can_return_object_from_api_response()
    {
        $mock = mk::mock('alias:Request');
        $mock->allows('staticRequest')
            ->with(mk::type('string'), mk::type('string'), mk::type('array'), mk::type('string'));
        $mock->staticRequest('get', 'customer', ['params'], 'sometype');
        $resource = $mock->expects(std::class);
        $this->assertEquals('object', gettype($resource));
    }

    /** @test */
    public function it_can_return_array_from_api_response()
    {
        $mock = mk::mock('alias:Request');
        $mock->allows('staticRequest')
            ->with(mk::type('string'), mk::type('string'), mk::type('array'), mk::type('string'));
        $mock->staticRequest('get', 'customers', ['params'], 'arr');
        $resource = $mock->expects([]);
        $this->assertEquals('array', gettype([$resource]));
    }

    /** @test */
    public function it_can_return_exception_when_request_method_is_null()
    {
        $this->expectException(IsNullException::class);
        $resp = Request::staticRequest(null, 'customers', [], 'obj');
    }

    /** @test */
    public function it_can_return_api_error_exception()
    {
        $this->expectException(ApiErrorException::class);
        Rate::current();
    }
}
