# oura-api-php
[![Latest Stable Version](https://poser.pugx.org/tai-sho/oura-api-php/v/stable)](https://packagist.org/packages/tai-sho/oura-api-php)
[![Build Status](https://github.com/tai-sho/oura-api-php/actions/workflows/code_check.yml/badge.svg)](https://github.com/tai-sho/oura-api-php/actions/workflows/code_check.yml)
[![Coverage Status](https://coveralls.io/repos/github/tai-sho/oura-api-php/badge.svg?branch=main)](https://coveralls.io/github/tai-sho/oura-api-php?branch=main)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue)](https://packagist.org/packages/tai-sho/oura-api-php)
[![License](https://poser.pugx.org/tai-sho/oura-api-php/license)](https://packagist.org/packages/tai-sho/oura-api-php)
[![Twitter Follow](https://img.shields.io/twitter/follow/tai-sho.svg?style=social&label=Follow)](https://twitter.com/tai-sho)

A PHP client library for the Oura Ring API.

## Requirements

- PHP 7.4 or higher
- Composer
- Oura Personal Access Token (see below for more information)

## Installation

You can install the library via Composer. Run the following command:

```bash
$ composer require tai-sho/oura-api-php
```

# Usage
## Personal Access Token
This library requires a personal access token to authenticate with the Oura API. You can obtain a personal access token from the Oura page:
[Oura API Doc](https://cloud.ouraring.com/docs)

## Initialization
First, you need to initialize the client with your API access token.
```php
require 'vendor/autoload.php';

use OuraApiPhp\Client;

$accessToken = 'your-access-token';
$client = new Client($accessToken);
```

## Examples
### Get Heart Rate Data
```php
$params = ['start_date' => '2024-01-01', 'end_date' => '2024-01-07'];
$response = $client->getHeartRate($params);
$data = json_decode($response->getBody()->getContents(), true);
print_r($data);
```
### Get Personal Info
```php
$response = $client->getPersonalInfo();
$data = json_decode($response->getBody()->getContents(), true);
print_r($data);

```
### Get Workout Data
```php
$params = ['start_date' => '2024-01-01', 'end_date' => '2024-01-07'];
$response = $client->getWorkout($params);
$data = json_decode($response->getBody()->getContents(), true);
print_r($data);
```
### Get All Heart Rate Data (Handling Pagination)
```php
$params = ['start_date' => '2024-01-01', 'end_date' => '2024-01-07'];
$responses = $client->getAllHeartRateData($params);
foreach ($responses as $response) {
    $data = json_decode($response->getBody()->getContents(), true);
    print_r($data);
}

```
## Available Endpoints
The client supports the following endpoints:

- `getHeartRate(array $params = [])`
- `getPersonalInfo(array $params = [])`
- `getTag(array $params = [])`
- `getEnhancedTag(array $params = [])`
- `getWorkout(array $params = [])`
- `getSession(array $params = [])`
- `getDailyActivity(array $params = [])`
- `getDailySleep(array $params = [])`
- `getDailySpo2(array $params = [])`
- `getDailyReadiness(array $params = [])`
- `getSleep(array $params = [])`
- `getSleepTime(array $params = [])`
- `getRestModePeriod(array $params = [])`
- `getRingConfiguration(array $params = [])`
- `getDailyStress(array $params = [])`
- `getTagById(string $documentId, array $params = [])`
- `getEnhancedTagById(string $documentId, array $params = [])`
- `getWorkoutById(string $documentId, array $params = [])`
- `getSessionById(string $documentId, array $params = [])`
- `getDailyActivityById(string $documentId, array $params = [])`
- `getDailySleepById(string $documentId, array $params = [])`
- `getDailySpo2ById(string $documentId, array $params = [])`
- `getDailyReadinessById(string $documentId, array $params = [])`
- `getSleepById(string $documentId, array $params = [])`
- `getSleepTimeById(string $documentId, array $params = [])`
- `getRestModePeriodById(string $documentId, array $params = [])`
- `getRingConfigurationById(string $documentId, array $params = [])`
- `getDailyStressById(string $documentId, array $params = [])`

## Get All Data Functions (Handling Pagination)
- `getAllHeartRateData(array $params = [])`
- `getAllWorkoutData(array $params = [])`
- `getAllTagData(array $params = [])`
- `getAllEnhancedTagData(array $params = [])`
- `getAllSessionData(array $params = [])`
- `getAllDailyActivityData(array $params = [])`
- `getAllDailySleepData(array $params = [])`
- `getAllDailySpo2Data(array $params = [])`
- `getAllDailyReadinessData(array $params = [])`
- `getAllSleepData(array $params = [])`
- `getAllSleepTimeData(array $params = [])`
- `getAllRestModePeriodData(array $params = [])`
- `getAllRingConfigurationData(array $params = [])`
- `getAllDailyStressData(array $params = [])`

# Contributing
Welcome contributions! Please submit a pull request or open an issue to discuss changes.

# Lisence
This project is licensed under the MIT License. See the [LICENSE](https://github.com/tai-sho/oura-api-php/blob/main/LICENSE) file for details.
