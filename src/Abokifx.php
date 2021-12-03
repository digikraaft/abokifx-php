<?php

namespace Digikraaft\Abokifx;

use Digikraaft\Abokifx\Exceptions\InvalidArgumentException;

class Abokifx extends ApiResource
{
    /** @var string The abokiFX API key to be used for requests. */
    public static string $apiToken;

    /** @var string The base URL for the Abokifx API. */
    public static $apiBaseUrl = 'https://abokifx.com/api/v1';

    /**
     * @return string the API key used for requests
     */
    public static function getApiToken()
    {
        return self::$apiToken;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param string $apiToken
     */
    public static function setApiToken($apiToken)
    {
        self::validateApiKey($apiToken);
        self::$apiToken = $apiToken;
    }

    /**
     * @param $apiKey
     * @return bool
     * @throws InvalidArgumentException
     */
    private static function validateApiKey($apiKey)
    {
        if ($apiKey == '' || ! is_string($apiKey)) {
            throw new InvalidArgumentException('Secret key must be a string and cannot be empty');
        }

        return true;
    }
}
