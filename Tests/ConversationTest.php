<?php
/**
 * Copyright 2017 IBM Corp. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace WatsonSDK\Tests;

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Common\SimpleTokenHelper;
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\InvalidParameterException;

use WatsonSDK\Services\Conversation;
use WatsonSDK\Services\Conversation\InputDataModel;
use WatsonSDK\Services\Conversation\MessageRequestModel;
use WatsonSDK\Services\Conversation\ContextModel;
use WatsonSDK\Services\Conversation\EntityModel;
use WatsonSDK\Services\Conversation\IntentModel;
use WatsonSDK\Services\Conversation\OutputDataModel;
use WatsonSDK\Services\Conversation\SystemResponseModel;
use WatsonSDK\Services\Conversation\DialogModel;

final class ConversationTest extends BaseTestCase {

    /**
     * Conversation unit test with model using basic authentication
     */
    public function testConversationWithModel () {

        $username = getenv('CONVERSATION_USERNAME');
        $password = getenv('CONVERSATION_PASSWORD');
        $workspace_id = getenv('CONVERSATION_WORKSPACE_ID');

        $conversation = new Conversation( WatsonCredential::initWithCredentials($username, $password) );

        $this->assertInstanceOf(
            Conversation::class, 
            $conversation
        );

        if(isset($username) && isset($password) && isset($workspace_id)) {
            $greetings = $conversation->sendMessage( '', $workspace_id );
            $this->assertEquals(200, $greetings->getStatusCode());

            $result = $greetings->getContent(TRUE);
            $context = $result['context'];
            $system = $context['system'];

            $dialogModel = new DialogModel( $system['dialog_stack'][0]['dialog_node'] );

            $systemModel = new SystemResponseModel( $dialogModel, $system['dialog_turn_counter'], $system['dialog_request_counter'] );

            $contextModel = new ContextModel( $context['conversation_id'], $systemModel );

            $model = new MessageRequestModel( 'What is IBM?', NULL, $contextModel, new EntityModel(), new IntentModel(), new OutputDataModel() );

            $this->assertNull($model->getEntities());
            $this->assertNull($model->getIntents());
            $this->assertNull($model->getOutput());

            $answer = $conversation->sendMessage( $model, $workspace_id );
            $this->assertEquals(200, $answer->getStatusCode());

        }
    }

    /**
     * Conversation unit test for raising InvalidParameterException
     */
    public function testConversationInvalidParameterException () {

        $this->expectException(InvalidParameterException::class);

        $conversation = new Conversation( WatsonCredential::initWithCredentials('invalid-username', 'invalid-password') );

        $result = $conversation->sendMessage( 0, 'invalid-workspace-id' );
        $this->assertEquals(200, $result->getStatusCode());
    }

}