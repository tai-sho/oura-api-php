<?php

declare(strict_types=1);

namespace OuraApiPhp\Tests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OuraApiPhp\Client;
use PHPUnit\Framework\TestCase;
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
     * Tests the getPersonalInfo method
     */
    public function testGetPersonalInfo(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getPersonalInfo([]);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getTag method
     */
    public function testGetTag(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getTag([]);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getEnhancedTag method
     */
    public function testGetEnhancedTag(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getEnhancedTag([]);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getWorkout method
     */
    public function testGetWorkout(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getWorkout(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getSession method
     */
    public function testGetSession(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getSession(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailyActivity method
     */
    public function testGetDailyActivity(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailyActivity(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailySleep method
     */
    public function testGetDailySleep(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailySleep(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailySpo2 method
     */
    public function testGetDailySpo2(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailySpo2(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailyReadiness method
     */
    public function testGetDailyReadiness(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailyReadiness(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getSleep method
     */
    public function testGetSleep(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getSleep(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getSleepTime method
     */
    public function testGetSleepTime(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getSleepTime(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getRestModePeriod method
     */
    public function testGetRestModePeriod(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getRestModePeriod(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getRingConfiguration method
     */
    public function testGetRingConfiguration(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getRingConfiguration(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailyStress method
     */
    public function testGetDailyStress(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailyStress(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getTagById method
     */
    public function testGetTagById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getTagById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getEnhancedTagById method
     */
    public function testGetEnhancedTagById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getEnhancedTagById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getWorkoutById method
     */
    public function testGetWorkoutById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getWorkoutById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getSessionById method
     */
    public function testGetSessionById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getSessionById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailyActivityById method
     */
    public function testGetDailyActivityById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailyActivityById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailySleepById method
     */
    public function testGetDailySleepById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailySleepById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailySpo2ById method
     */
    public function testGetDailySpo2ById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailySpo2ById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailyReadinessById method
     */
    public function testGetDailyReadinessById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailyReadinessById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getSleepById method
     */
    public function testGetSleepById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getSleepById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getSleepTimeById method
     */
    public function testGetSleepTimeById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getSleepTimeById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getRestModePeriodById method
     */
    public function testGetRestModePeriodById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getRestModePeriodById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getRingConfigurationById method
     */
    public function testGetRingConfigurationById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getRingConfigurationById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getDailyStressById method
     */
    public function testGetDailyStressById(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $response = $client->getDailyStressById('some-id', []);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['key' => 'value', 'next_token' => 'next123'], $data);
    }

    /**
     * Tests the getAllHeartRateData method
     */
    public function testGetAllHeartRate(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllHeartRate(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllWorkoutData method
     */
    public function testGetAllWorkout(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllWorkout(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllTagData method
     */
    public function testGetAllTag(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllTag([]);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllEnhancedTagData method
     */
    public function testGetAllEnhancedTag(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllEnhancedTag([]);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllSessionData method
     */
    public function testGetAllSession(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllSession(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllDailyActivityData method
     */
    public function testGetAllDailyActivity(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllDailyActivity(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllDailySleepData method
     */
    public function testGetAllDailySleep(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllDailySleep(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllDailySpo2Data method
     */
    public function testGetAllDailySpo2(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllDailySpo2(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllDailyReadinessData method
     */
    public function testGetAllDailyReadiness(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllDailyReadiness(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllSleepData method
     */
    public function testGetAllSleep(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllSleep(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllSleepTimeData method
     */
    public function testGetAllSleepTime(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllSleepTime(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllRestModePeriodData method
     */
    public function testGetAllRestModePeriod(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllRestModePeriod(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllRingConfigurationData method
     */
    public function testGetAllRingConfiguration(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllRingConfiguration(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }

    /**
     * Tests the getAllDailyStressData method
     */
    public function testGetAllDailyStress(): void
    {
        $client = new Client($this->accessToken);
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($client, $this->mockHttpClient);

        $responses = $client->getAllDailyStress(['start_date' => '2023-01-01', 'end_date' => '2023-01-07']);

        $this->assertCount(2, $responses);
        $this->assertInstanceOf(ResponseInterface::class, $responses[0]);
        $this->assertInstanceOf(ResponseInterface::class, $responses[1]);
    }
}
