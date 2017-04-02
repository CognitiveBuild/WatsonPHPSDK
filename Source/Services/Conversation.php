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

namespace WatsonSDK\Services;

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpResponse;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;
use WatsonSDK\Common\WatsonService;
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\InvalidParameterException;

use WatsonSDK\Services\Conversation\MessageRequestModel;

/**
 * Conversation class
 */
class Conversation extends WatsonService {

    const BASE_URL = 'https://gateway.watsonplatform.net/conversation/api/v1';
    const VERSION = '2017-02-03';

    private $_context = NULL;

    /**
     * Send message to Conversation service by using the MessageRequestModel instance
     * 
     * @param MessageRequestModel $model
     * @param $workspace_id string
     * @param $version string
     * @return HttpResponse
     */
    public function sendMessageByModel(MessageRequestModel $model, $workspace_id, $version = self::VERSION) {

        $config = $this->initConfig();
        $config->addHeaders($model->getData('@header'));

        $config->setData($model->getData('@data'));

        $config->setQuery( [ 'version' => $version ] );
        $config->setMethod(HttpClientConfiguration::METHOD_POST);
        $config->setType(HttpClientConfiguration::DATA_TYPE_JSON);

        $url = self::BASE_URL."/workspaces/{$workspace_id}/message";

        $config->setURL($url);

        $response = $this->sendRequest($config);

        return $response;
    }

    /**
     * Send text message to Conversation service
     * 
     * @param $message string
     * @return HttpResponse
     */
    public function sendMessageByText($message, $workspace_id, $version = self::VERSION) {

        $model = new MessageRequestModel($message);
        return $this->sendMessageByModel($model, $workspace_id, $version);
    }

    /**
     * Send message to Conversation service
     * 
     * @param  $val MessageRequestModel | string
     * @return HttpResponse
     */
    public function sendMessage($val, $workspace_id, $version = self::VERSION) {

        if($val instanceof MessageRequestModel) {
            return $this->sendMessageByModel($val, $workspace_id, $version);
        }

        if(is_string($val)) {
            return $this->sendMessageByText($val, $workspace_id, $version);
        }

        throw new InvalidParameterException();
    }

}