<?php
declare(strict_types=1);

namespace OuraApiPhp\Tests;

use OuraApiPhp\Client;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class ClientTest extends TestCase
{
    private $mockHttpClient;
    private $accessToken = 'your-access-token';

    protected function setUp(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['key' => 'value'])),
            new RequestException("Error Communicating with Server", new Request('GET', 'some-endpoint'))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->mockHttpClient = new GuzzleClient(['handler' => $handlerStack]);
    }

    public function testCanBeInstantiated(): void
    {
        $client = new Client($this->accessToken);
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testGetRequest(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->get('some-endpoint');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value'], $data);
    }

    public function testGetRequestThrowsException(): void
    {
        $mock = new MockHandler([
            new RequestException("Error Communicating with Server", new Request('GET', 'some-endpoint'))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $mockHttpClient = new GuzzleClient(['handler' => $handlerStack]);

        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $mockHttpClient);

        $this->expectException(\RuntimeException::class);
        $client->get('some-endpoint');
    }
}

