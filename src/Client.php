<?php

declare(strict_types=1);

namespace OuraApiPhp;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class Client
{
    private GuzzleClient $httpClient;
    private string $accessToken;
    private string $baseUri = 'https://api.ouraring.com';
    private string $apiVersion;

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

    public function getHeartRate(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/heartrate', $params);
    }

    public function getWorkout(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/workout', $params);
    }

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

    public function getAllHeartRateData(array $params = []): array
    {
        return $this->getAllPages('usercollection/heartrate', $params);
    }

    public function getAllWorkoutData(array $params = []): array
    {
        return $this->getAllPages('usercollection/workout', $params);
    }

}

