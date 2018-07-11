<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Tests/Environment.php';

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Common\SimpleTokenHelper;
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\WatsonUtility;
use WatsonSDK\Common\InvalidParameterException;

use WatsonSDK\Tests\Environment;
use WatsonSDK\Services\Assistant;
use WatsonSDK\Services\Assistant\InputDataModel;
use WatsonSDK\Services\Assistant\MessageRequestModel;
use WatsonSDK\Services\Assistant\ContextModel;
use WatsonSDK\Services\Assistant\RuntimeEntityModel;
use WatsonSDK\Services\Assistant\IntentModel;
use WatsonSDK\Services\Assistant\OutputDataModel;
use WatsonSDK\Services\Assistant\SystemResponseModel;
use WatsonSDK\Services\Assistant\DialogModel;

use WatsonSDK\Services\PersonalityInsights;
use WatsonSDK\Services\PersonalityInsights\ProfileModel;
use WatsonSDK\Services\PersonalityInsights\ContentItemModel;
use WatsonSDK\Services\NaturalLanguageUnderstanding;
use WatsonSDK\Services\NaturalLanguageUnderstanding\AnalyzeModel;

$env = new Environment(__DIR__ . '/../Tests/');
$env->load();

print_r( new RuntimeEntityModel() );
