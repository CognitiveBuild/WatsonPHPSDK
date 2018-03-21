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

$env = new Environment(__DIR__ . '/../Tests/');
$env->load();

$username = getenv('CONVERSATION_USERNAME');
$password = getenv('CONVERSATION_PASSWORD');
$workspace_id = getenv('CONVERSATION_WORKSPACE_ID');

// $conversation = new Conversation( WatsonCredential::initWithCredentials($username, $password) );
// $dialog = new DialogModel( 'root' );
// $context = new ContextModel('d9e6854b-7360-4733-8f11-84635ad091b6', new SystemResponseModel($dialog, 1, 1));
// $entity = new EntityModel();
// $intent = new IntentModel();
// $output = new OutputDataModel([ 'Hi there, I am Watson' ], [ 'Hi there, I am Watson' ], [ 'Conversation Start', 'Conversation Start' ]);

// $result = $conversation->sendMessage( new MessageRequestModel( '' ), $workspace_id );

echo "\n\r";

// $result = $conversation->listWorkspaces(5, TRUE, Conversation::SORT_BY_NAME_DESC);

// print_r($result->getContent(TRUE));

$dialog = new DialogModel( 'root' );
$model = new MessageRequestModel( 'Hi Watson', NULL, [ 
        new ContextModel('test 1', new SystemResponseModel($dialog, 1, 1)), 
        new ContextModel('test 2', new SystemResponseModel($dialog, 1, 2)) 
    ]
);

$model->getData();

die;

// $model = new MessageRequestModel( '' );
// WatsonUtility::map($result->getContent(TRUE), $model);

// print_r($model);

// echo "\n\r";

// $content = $result->getContent(TRUE);

// $model = new MessageRequestModel( 'What is IBM?' );
// $model->setContext($content['context']);
// $result = $conversation->sendMessage( $model, $workspace_id );

// echo "\n\r";

// print_r($result->getContent(TRUE));

// echo "\n\r";
