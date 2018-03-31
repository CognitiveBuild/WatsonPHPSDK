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
use WatsonSDK\Services\Conversation;
use WatsonSDK\Services\Conversation\InputDataModel;
use WatsonSDK\Services\Conversation\MessageRequestModel;
use WatsonSDK\Services\Conversation\ContextModel;
use WatsonSDK\Services\Conversation\EntityModel;
use WatsonSDK\Services\Conversation\IntentModel;
use WatsonSDK\Services\Conversation\OutputDataModel;
use WatsonSDK\Services\Conversation\SystemResponseModel;
use WatsonSDK\Services\Conversation\DialogModel;

use WatsonSDK\Services\PersonalityInsights\ProfileModel;
use WatsonSDK\Services\PersonalityInsights\ContentItemModel;
use WatsonSDK\Services\NaturalLanguageUnderstanding;
use WatsonSDK\Services\NaturalLanguageUnderstanding\AnalyzeModel;

$env = new Environment(__DIR__ . '/../Tests/');
$env->load();
