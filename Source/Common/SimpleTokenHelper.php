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
use WatsonSDK\Common\HttpClientException;

class SimpleTokenHelper {

    const SERVICE_AUTHENTICATION_URL = 'https://gateway.watsonplatform.net/authorization/api/v1/token';
    const STREAM_AUTHENTICATION_URL = 'https://stream.watsonplatform.net/authorization/api/v1/token';

    /**
     * Request a new token
     * 
     * @param $username string
     * @param $password string
     * @param $serviceUrl string
     * @param $authenticationUrl string
     * 
     * @return string
     */
    public static function requestToken($username, $password, $serviceUrl, $authenticationUrl = self::SERVICE_AUTHENTICATION_URL) {

        $token = '';
        $httpClient = new HttpClient();
        $httpConfig = new HttpClientConfiguration();

        if(isset($username) && isset($password)) {

            $httpConfig->setCredentials([ $username, $password ]);
            $httpConfig->setMethod(HttpClientConfiguration::METHOD_GET);
            $httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
            $httpConfig->setQuery([ 'url' => $serviceUrl ]);
            $httpConfig->setURL($authenticationUrl);

            try {
                $token = $httpClient->request($httpConfig);
            }
            catch(HttpClientException $ex) {

            }
        }

        return $token;
    }
}