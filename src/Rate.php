<?php

namespace Digikraaft\Abokifx;

use Digikraaft\Abokifx\Util\Util;

class Rate extends ApiResource
{
    const OBJECT_NAME = 'rates';

    /**
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.abokifx.com/api_references
     */
    public static function current()
    {
        $url = self::endPointUrl("movement");

        return static::staticRequest('GET', $url);
    }

    /**
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.abokifx.com/api_references
     */
    public static function previous()
    {
        $url = self::endPointUrl("lagos_previous");

        return static::staticRequest('GET', $url);
    }

    /**
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.abokifx.com/api_references
     */
    public static function parallel()
    {
        $url = self::endPointUrl("otherparallel");

        return static::staticRequest('GET', $url);
    }

    /**
     * @param array|null $params
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.abokifx.com/api_references
     */
    public static function withDate(array $params = null)
    {
        //24-04-2020
        self::validateParams($params);
        $url = self::endPointUrl("date");
        if (! empty($params)) {
            $url .= '?'.http_build_query($params);
        }

        return static::staticRequest('GET', $url);
    }

}
