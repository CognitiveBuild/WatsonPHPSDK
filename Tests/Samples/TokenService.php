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

namespace WatsonSDK\Samples;

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpResponse;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;

class TokenService {

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
     * Invoke `token` service
     * 
     * @return HttpResponse
     */
    public function Token(TokenServiceModel $model) {

        $this->_httpConfig->setData($model->getData());

        $this->_httpConfig->setCredentials([ $model->getUsername(), $model->getPassword() ]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_GET);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setQuery([ 'url' => $model->getUrl() ]);
        $this->_httpConfig->setURL(TokenServiceModel::BASE_URL."/token");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response=new HttpResponse($ex->getCode(),$ex->getMessage());
            return $response;
        }
    }
}
