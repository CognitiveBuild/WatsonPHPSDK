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
    protected $_httpConfig;

    /**
     * Constructor
     * 
     * @param $credential WatsonCredential
     */
    function __construct(WatsonCredential $credential) {

        $this->_httpClient = new HttpClient();
        $this->_httpConfig = new HttpClientConfiguration();

        if(is_null($credential->getTokenProvider())) {
            // Basic authentication
            $this->_httpConfig->setCredentials([ $credential->getUsername(), $credential->getPassword() ]);
        }
        else {
            // Token authentication
            $token = $credential->getTokenProvider()->getToken();
            $credential->setToken($token);
            $this->_httpConfig->setHeader([ 'X-Watson-Authorization-Token' => $credential->getToken() ]);
        }
    }
}