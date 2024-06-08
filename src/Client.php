<?php
declare(strict_types=1);

namespace OuraApiPhp;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private GuzzleClient $httpClient;
    private string $accessToken;

    public function __construct(string $accessToken)
    {
        $this->httpClient = new GuzzleClient([
            'base_uri' => 'https://api.ouraring.com/v2/',
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Accept' => 'application/json',
            ]
        ]);
        $this->accessToken = $accessToken;
    }

    private function request(string $method, string $endpoint, array $params = []): ResponseInterface
    {
        try {
            return $this->httpClient->request($method, $endpoint, ['query' => $params]);
        } catch (GuzzleException $e) {
            // HTTPリクエストが失敗した場合の例外処理
            throw new \RuntimeException('HTTP request failed: ' . $e->getMessage(), 0, $e);
        }
    }

    public function get(string $endpoint, array $params = []): ResponseInterface
    {
        return $this->request('GET', $endpoint, $params);
    }
}

