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
use WatsonSDK\Common\HttpClientException;

class SimpleTokenProvider implements TokenProviderInterface {

    private static $_token = NULL;
    private $_url = '';

    /**
     * Constructor
     * 
     * @param $url string | NULL
     * @param $token string | NULL
     * 
     * @throws InvalidParameterException
     */
    function __construct($url = NULL, $token = NULL) {

        if(is_null($url) && is_null($token)) {
            throw new InvalidParameterException();
        }

        $this->_url = $url;

        $this->setToken($token);
    }

    /**
     * Get token string
     * 
     * @return string
     */
    public function getToken() {

        if(is_null(self::$_token)) {
            $httpClient = new HttpClient();
            $config = new HttpClientConfiguration();
            $config->setURL($this->_url);
            try {
                $response = $httpClient->request($config);
                self::$_token = $response->getContent();
            }
            catch (HttpClientException $ex) {
                self::$_token = NULL;
            }
        }

        return self::$_token;
    }

    /**
     * Get token string
     * 
     * @param $token string
     */
    public function setToken($token) {
        self::$_token = $token;
    }
}