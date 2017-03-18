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

use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class HttpClient {

    /**
     * HttpClient instance
     */
    private $_request;

    /**
     * Constructor
     */
    function __construct() {

        $this->_request = new Client();
    }

    /**
     * Send out HTTP request
     * 
     * @param $config HttpClientConfiguration
     * @return HttpResponse
     * @throws HttpClientException
     */
    public function request(HttpClientConfiguration $config) {

        try {
            // Convert to Guzzle request options
            $options = $config->toOptions();

            // Send out HTTP request
            $response = $this->_request->request($config->getMethod(), $config->getURL(), $options);
            return new HttpResponse($response->getStatusCode(), $response->getBody()->getContents(), $response->getBody()->getSize());
        }
        catch (RequestException $e) {
            $message = $e->getMessage();

            if ($e->hasResponse()) {
                $message = Psr7\str($e->getResponse());
            }
            throw new HttpClientException($message, $e->getCode());
        }
    }

}