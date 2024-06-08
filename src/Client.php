<?php
declare(strict_types=1);

namespace OuraApiPhp;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private GuzzleClient $httpClient;
    private string $accessToken;

    public function __construct(string $accessToken)
    {
        $this->httpClient = new GuzzleClient([
            'base_uri' => 'https://api.ouraring.com/v2/'
        ]);
        $this->accessToken = $accessToken;
    }

    private function request(string $method, string $endpoint, array $params = []): ResponseInterface
    {
        return $this->httpClient->request($method, $endpoint, [
            'headers' => [
                'Authorization' => "Bearer {$this->accessToken}",
                'Accept' => 'application/json'
            ],
            'query' => $params
        ]);
    }

    public function get(string $endpoint, array $params = []): ResponseInterface
    {
        return $this->request('GET', $endpoint, $params);
    }
}

