<?php

declare(strict_types=1);

namespace OuraApiPhp\Tests;

use OuraApiPhp\Client;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \OuraApiPhp\Client
 */
class ClientTest extends TestCase
{
    /**
     * @var GuzzleClient Mock HTTP client
     */
    private $mockHttpClient;

    /**
     * @var string API access token
     */
    private $accessToken = 'your-access-token';

    /**
     * Sets up the test environment
     */
    protected function setUp(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['key' => 'value', 'next_token' => 'next123'])),
            new Response(200, [], json_encode(['key' => 'value2'])),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->mockHttpClient = new GuzzleClient(['handler' => $handlerStack]);
    }

    /**
     * Tests the instantiation of the Client class
     */
    public function testCanBeInstantiated(): void
    {
        $client = new Client($this->accessToken);
        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * Tests the getHeartRate method
     */
    public function testGetHeartRate(): void
    {
        $client = new Client($this->accessToken);
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

    /**
     * Tests the getAllHeartRateData method
     */
    public function testGetAllHeartRateData(): void
    {
        $client = new Client($this->accessToken);
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

