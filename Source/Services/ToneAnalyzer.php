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

class ToneAnalyzer {

    private $_httpClient;
    private $_httpConfig;

    /**
     * Constructor
     */
    function __construct() {

        $this->_httpClient = new HttpClient();
        $this->_httpConfig = new HttpClientConfiguration();
    }

    /**
     * Invoke `tone` service
     * 
     * @return HttpResponse
     */
    public function Tone(ToneAnalyzerModel $model) {

        $this->_httpConfig->setData($model->getData('@data'));
        $this->_httpConfig->setQuery($model->getData('@query'));

        if(is_null($model->getTokenProvider())) {
            // Basic authentication
            $this->_httpConfig->setCredentials([ $model->getUsername(), $model->getPassword() ]);
        }
        else {
            // Token authentication
            $token = $model->getTokenProvider()->getToken();
            $model->setToken($token);
            $this->_httpConfig->setHeader([ 'X-Watson-Authorization-Token' => $model->getToken() ]);
        }

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_POST);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(ToneAnalyzerModel::BASE_URL."/tone");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response=new HttpResponse($ex->getCode(),$ex->getMessage());
            return $response;
        }
    }
}
