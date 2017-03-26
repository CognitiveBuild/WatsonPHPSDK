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

namespace WatsonSDK\Common;

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\WatsonCredential;

class WatsonService {

    protected $_httpClient;
    private $_credential;
    private $_xWatsonLearningOptOut;

    /**
     * Constructor
     * 
     * @param $credential WatsonCredential
     * @param $xWatsonLearningOptOut boolean
     */
    function __construct(WatsonCredential $credential, $xWatsonLearningOptOut = NULL) {

        $this->_httpClient = new HttpClient();
        $this->_credential = $credential;
        $this->_xWatsonLearningOptOut = $xWatsonLearningOptOut;
    }

    /**
     * Prepare configurations and headers
     * 
     * @return HttpClientConfiguration
     */
    protected function initConfig() {

        $config = new HttpClientConfiguration();

        if(is_null($this->_credential->getTokenProvider())) {
            $config->setCredentials([ $this->_credential->getUsername(), $this->_credential->getPassword() ]);
        }
        else {
            $token = $this->_credential->getTokenProvider()->getToken();
            $this->_credential->setToken($token);
            $config->addHeader('X-Watson-Authorization-Token', $this->_credential->getToken());
        }

        if(is_null($this->_xWatsonLearningOptOut) == FALSE) {
            $config->addHeader('X-Watson-Learning-Opt-Out', $this->_xWatsonLearningOptOut);
        }

        return $config;
    }

    /**
     * Send out HTTP request
     * 
     * @param $config HttpClientConfiguration
     * 
     * @return HttpResponse
     */
    protected function sendRequest(HttpClientConfiguration $config) {

        try {
            return $this->_httpClient->request($config);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }
}