<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Tests/Environment.php';

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Common\SimpleTokenHelper;
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\InvalidParameterException;

use WatsonSDK\Services\PersonalityInsights;
use WatsonSDK\Services\PersonalityInsights\ProfileModel;
use WatsonSDK\Services\PersonalityInsights\ContentItemModel;

use WatsonSDK\Services\ToneAnalyzer;
use WatsonSDK\Services\ToneAnalyzer\ToneModel;

use WatsonSDK\Tests\Environment;

$env = new Environment(__DIR__ . '/../Tests/');
$env->load();

$username = getenv('TONE_ANALYZER_USERNAME');
$password = getenv('TONE_ANALYZER_PASSWORD');

$analyzer = new ToneAnalyzer( WatsonCredential::initWithCredentials($username, $password) );
$result = $analyzer->getTone( ' ' );
print_r($result);