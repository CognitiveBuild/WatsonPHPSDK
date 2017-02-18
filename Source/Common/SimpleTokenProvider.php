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

use WatsonSDK\Common\ITokenProvider;
use WatsonSDK\Common\InvalidParameterException;

class SimpleTokenProvider implements TokenProviderInterface {

    private $_token = NULL;
    private $_url = '';

    function __construct($url = NULL) {

        if(is_null($url)) {
            throw new InvalidParameterException();
        }

        $this->_url = $url;
    }

    public function getToken() {

        if(is_null($this->_token)) {
            $httpClient = new HttpClient();
            $config = new HttpClientConfiguration();
            $config->setURL($this->_url);
            $response = $httpClient->request($config);
            $this->_token = $response->getContent();
        }

        return $this->_token;
    }
}