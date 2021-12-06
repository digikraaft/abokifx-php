<?php

namespace Digikraaft\Abokifx\ApiOperations;

use Digikraaft\Abokifx\Abokifx;
use Digikraaft\Abokifx\Exceptions\ApiErrorException;
use Digikraaft\Abokifx\Exceptions\InvalidArgumentException;
use Digikraaft\Abokifx\Exceptions\IsNullException;
use Digikraaft\Abokifx\Util\Util;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Trait for resources that need to make API requests.
 */
trait Request
{
    /**
     * Instance of Client.
     */
    protected static $client;

    /**
     *  Response from requests made to Abokifx.
     *
     * @var mixed
     */
    protected static $response;

    /**
     * @param null|array|mixed $params   The list of parameters to validate
     * @param bool             $required
     *
     * @throws InvalidArgumentException if $params exists and is not an array
     */
    public static function validateParams($params = null, $required = false): void
    {
        if ($required) {
            if (empty($params) || ! is_array($params)) {
                $message = 'The parameter passed must be an array and must not be empty';

                throw new InvalidArgumentException($message);
            }
        }
        if ($params && ! is_array($params)) {
            $message = 'The parameter passed must be an array';

            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @param string $method      HTTP method ('get', 'post', etc.)
     * @param string $url         URL for the request
     * @param array  $params      list of parameters for the request
     * @param string $return_type return array or object accepted values: 'arr' and 'obj'
     *
     * @throws InvalidArgumentException
     * @throws IsNullException
     *
     * @return array|object (the JSON response as array or object)
     */
    public static function staticRequest($method, $url, $params = [], $return_type = Abokifx::ARRAY_RESPONSE)
    {
        if (Abokifx::$responseType != Abokifx::ARRAY_RESPONSE && Abokifx::$responseType != Abokifx::OBJECT_RESPONSE) {
            throw new InvalidArgumentException('Return type can only be '. Abokifx::OBJECT_RESPONSE .' or '. Abokifx::ARRAY_RESPONSE);
        }
        static::setHttpResponse($method, $url, $params);

        if (Abokifx::$responseType == Abokifx::ARRAY_RESPONSE) {
            return static::getResponseData();
        }

        return Util::convertArrayToObject(static::getResponse());
    }

    /**
     * Set options for making the Client request.
     */
    protected static function setRequestOptions(): void
    {
        $auth = Abokifx::getApiToken();

        static::$client = new Client(
            [
                'base_uri' => Abokifx::$apiBaseUrl,
                'headers' => [
                    'Authorization' => "Bearer " . $auth,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ]
        );
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $body
     *
     * @throws IsNullException
     * @throws ApiErrorException
     */
    private static function setHttpResponse($method, $url, $body = []): \GuzzleHttp\Psr7\Response
    {
        if (is_null($method)) {
            throw new IsNullException('Empty method not allowed');
        }

        static::setRequestOptions();

        try {
            static::$response = static::$client->{strtolower($method)}(
                Abokifx::$apiBaseUrl . '/' . $url,
                ['body' => json_encode($body)]
            );

            return static::$response;
        } catch (ClientException $exception) {
            throw new ApiErrorException($exception->getMessage());
        }
    }

    /**
     * Get the data response from an API operation.
     *
     * @return array
     */
    private static function getResponse(): array
    {
        return json_decode(static::$response->getBody(), true);
    }

    /**
     * Get the data response from a get operation.
     *
     * @return array
     */
    private static function getResponseData(): array
    {
        return json_decode(static::$response->getBody(), true)['response'];
    }
}
