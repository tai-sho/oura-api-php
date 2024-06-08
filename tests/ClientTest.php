<?php

declare(strict_types=1);

namespace OuraApiPhp\Tests;

use OuraApiPhp\OuraApiClient;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends TestCase
{
    private $mockHttpClient;
    private $accessToken = 'your-access-token';

    protected function setUp(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['key' => 'value', 'next_token' => 'next123'])),
            new Response(200, [], json_encode(['key' => 'value2'])),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->mockHttpClient = new GuzzleClient(['handler' => $handlerStack]);
    }

    public function testCanBeInstantiated(): void
    {
        $client = new OuraApiClient($this->accessToken);
        $this->assertInstanceOf(OuraApiClient::class, $client);
    }

    public function testGetHeartRate(): void
    {
        $client = new OuraApiClient($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getHeartRate(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    public function testGetAllHeartRateData(): void
    {
        $client = new OuraApiClient($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllHeartRateData(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }
}

