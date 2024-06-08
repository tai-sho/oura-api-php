<?php

declare(strict_types=1);

namespace OuraApiPhp;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

/**
 * Oura API Client
 */
class Client
{
    /**
     * @var GuzzleClient Guzzle HTTP Client
     */
    private GuzzleClient $httpClient;

    /**
     * @var string API access token
     */
    private string $accessToken;

    /**
     * @var string Base URI for the Oura API
     */
    private string $baseUri = 'https://api.ouraring.com';

    /**
     * @var string API version
     */
    private string $apiVersion;

    /**
     * Client constructor.
     *
     * @param string $accessToken API access token
     * @param string $apiVersion API version (default: 'v2')
     */
    public function __construct(string $accessToken, string $apiVersion = 'v2')
    {
        $this->httpClient = new GuzzleClient([
            'base_uri' => $this->baseUri,
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Accept' => 'application/json',
            ],
        ]);
        $this->accessToken = $accessToken;
        $this->apiVersion = $apiVersion;
    }

    /**
     * Makes a request to the Oura API
     *
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $endpoint API endpoint
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     * @throws RuntimeException if the request fails
     */
    private function makeRequest(string $method, string $endpoint, array $params = []): ResponseInterface
    {
        $uri = sprintf('/%s/%s', $this->apiVersion, $endpoint);
        $options = [];
        if (!empty($params)) {
            $options['query'] = $params;
        }

        try {
            return $this->httpClient->request($method, $uri, $options);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Retrieves heart rate data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getHeartRate(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/heartrate', $params);
    }

    /**
     * Retrieves workout data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getWorkout(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/workout', $params);
    }

    /**
     * Retrieves all pages of data for a given endpoint
     *
     * @param string $endpoint API endpoint
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllPages(string $endpoint, array $params = []): array
    {
        $allResponses = [];
        $nextToken = null;

        do {
            if ($nextToken) {
                $params['next_token'] = $nextToken;
            }

            $response = $this->makeRequest('GET', $endpoint, $params);
            $allResponses[] = $response;

            $data = json_decode($response->getBody()->getContents(), true);
            $nextToken = $data['next_token'] ?? null;

        } while ($nextToken);

        return $allResponses;
    }

    /**
     * Retrieves all heart rate data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllHeartRateData(array $params = []): array
    {
        return $this->getAllPages('usercollection/heartrate', $params);
    }

    /**
     * Retrieves all workout data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllWorkoutData(array $params = []): array
    {
        return $this->getAllPages('usercollection/workout', $params);
    }

}

