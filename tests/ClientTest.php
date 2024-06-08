<?php

declare(strict_types=1);

namespace OuraApiPhp\Tests;

use OuraApiPhp\Client;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response;

class ClientTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $client = new Client('your-access-token');
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testGetRequest(): void
    {
        $mockResponse = new Response(200, [], json_encode(['key' => 'value']));
        $mock = new \GuzzleHttp\Handler\MockHandler([$mockResponse]);
        $handlerStack = \GuzzleHttp\HandlerStack::create($mock);
        $httpClient = new \GuzzleHttp\Client(['handler' => $handlerStack]);

        $client = new Client('your-access-token');
        $clientReflection = new \ReflectionClass(Client::class);
        $property = $clientReflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $httpClient);

        $response = $client->get('some-endpoint');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value'], $data);
    }
}

