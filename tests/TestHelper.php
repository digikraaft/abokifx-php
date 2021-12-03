<?php

namespace Digikraaft\Abokifx\Tests;

use Digikraaft\Abokifx\Abokifx;

class TestHelper
{
    public static function setup()
    {
        Abokifx::$apiBaseUrl = 'https://abokifx.com/api/v1';
        Abokifx::setApiToken('sec-sdddsje');
    }
}
