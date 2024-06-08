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
     * Retrieves personal info data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getPersonalInfo(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/personal_info', $params);
    }

    /**
     * Retrieves tag data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getTag(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/tag', $params);
    }

    /**
     * Retrieves enhanced tag data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getEnhancedTag(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/enhanced_tag', $params);
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
     * Retrieves session data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getSession(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/session', $params);
    }

    /**
     * Retrieves daily activity data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailyActivity(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/daily_activity', $params);
    }

    /**
     * Retrieves daily sleep data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailySleep(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/daily_sleep', $params);
    }

    /**
     * Retrieves daily SPO2 data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailySpo2(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/daily_spo2', $params);
    }

    /**
     * Retrieves daily readiness data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailyReadiness(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/daily_readiness', $params);
    }

    /**
     * Retrieves sleep data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getSleep(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/sleep', $params);
    }

    /**
     * Retrieves sleep time data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getSleepTime(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/sleep_time', $params);
    }

    /**
     * Retrieves rest mode period data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getRestModePeriod(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/rest_mode_period', $params);
    }

    /**
     * Retrieves ring configuration data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getRingConfiguration(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/ring_configuration', $params);
    }

    /**
     * Retrieves daily stress data
     *
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailyStress(array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', 'usercollection/daily_stress', $params);
    }

    /**
     * Retrieves tag data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getTagById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/tag/{$documentId}", $params);
    }

    /**
     * Retrieves enhanced tag data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getEnhancedTagById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/enhanced_tag/{$documentId}", $params);
    }

    /**
     * Retrieves workout data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getWorkoutById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/workout/{$documentId}", $params);
    }

    /**
     * Retrieves session data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getSessionById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/session/{$documentId}", $params);
    }

    /**
     * Retrieves daily activity data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailyActivityById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/daily_activity/{$documentId}", $params);
    }

    /**
     * Retrieves daily sleep data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailySleepById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/daily_sleep/{$documentId}", $params);
    }

    /**
     * Retrieves daily SPO2 data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailySpo2ById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/daily_spo2/{$documentId}", $params);
    }

    /**
     * Retrieves daily readiness data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailyReadinessById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/daily_readiness/{$documentId}", $params);
    }

    /**
     * Retrieves sleep data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getSleepById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/sleep/{$documentId}", $params);
    }

    /**
     * Retrieves sleep time data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getSleepTimeById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/sleep_time/{$documentId}", $params);
    }

    /**
     * Retrieves rest mode period data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getRestModePeriodById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/rest_mode_period/{$documentId}", $params);
    }

    /**
     * Retrieves ring configuration data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getRingConfigurationById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/ring_configuration/{$documentId}", $params);
    }

    /**
     * Retrieves daily stress data by document ID
     *
     * @param string $documentId Document ID
     * @param array $params Query parameters
     * @return ResponseInterface PSR-7 Response object
     */
    public function getDailyStressById(string $documentId, array $params = []): ResponseInterface
    {
        return $this->makeRequest('GET', "usercollection/daily_stress/{$documentId}", $params);
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

    /**
     * Retrieves all tag data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllTagData(array $params = []): array
    {
        return $this->getAllPages('usercollection/tag', $params);
    }

    /**
     * Retrieves all enhanced tag data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllEnhancedTagData(array $params = []): array
    {
        return $this->getAllPages('usercollection/enhanced_tag', $params);
    }

    /**
     * Retrieves all session data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllSessionData(array $params = []): array
    {
        return $this->getAllPages('usercollection/session', $params);
    }

    /**
     * Retrieves all daily activity data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllDailyActivityData(array $params = []): array
    {
        return $this->getAllPages('usercollection/daily_activity', $params);
    }

    /**
     * Retrieves all daily sleep data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllDailySleepData(array $params = []): array
    {
        return $this->getAllPages('usercollection/daily_sleep', $params);
    }

    /**
     * Retrieves all daily SPO2 data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllDailySpo2Data(array $params = []): array
    {
        return $this->getAllPages('usercollection/daily_spo2', $params);
    }

    /**
     * Retrieves all daily readiness data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllDailyReadinessData(array $params = []): array
    {
        return $this->getAllPages('usercollection/daily_readiness', $params);
    }

    /**
     * Retrieves all sleep data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllSleepData(array $params = []): array
    {
        return $this->getAllPages('usercollection/sleep', $params);
    }

    /**
     * Retrieves all sleep time data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllSleepTimeData(array $params = []): array
    {
        return $this->getAllPages('usercollection/sleep_time', $params);
    }

    /**
     * Retrieves all rest mode period data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllRestModePeriodData(array $params = []): array
    {
        return $this->getAllPages('usercollection/rest_mode_period', $params);
    }

    /**
     * Retrieves all ring configuration data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllRingConfigurationData(array $params = []): array
    {
        return $this->getAllPages('usercollection/ring_configuration', $params);
    }

    /**
     * Retrieves all daily stress data, handling pagination
     *
     * @param array $params Query parameters
     * @return ResponseInterface[] Array of PSR-7 Response objects
     */
    public function getAllDailyStressData(array $params = []): array
    {
        return $this->getAllPages('usercollection/daily_stress', $params);
    }
}

