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

use PHPUnit\Framework\TestCase;

final class HttpClientTest extends TestCase {

    public function testHttpClientConfigurationDefaultValues(){

        $config = new HttpClientConfiguration();

        $this->assertInstanceOf(
            HttpClientConfiguration::class, 
            $config
        );

        // Test default settings
        $this->assertEquals($config->getMethod(), 'GET');
        $this->assertNull($config->getURL());
        $this->assertEquals($config->getTimeout(), 0);

        $options = $config->toOptions();
    }

    // 
    public function testHttpClientRequest(){

        $httpClient = new HttpClient();
        $config = new HttpClientConfiguration();
        $config->setURL('https://www.ibm.com/watson/developercloud/');
        $this->assertEquals($config->getURL(), 'https://www.ibm.com/watson/developercloud/');
        $response = $httpClient->request($config);

        $this->assertInstanceOf(
            HttpClient::class, 
            $httpClient
        );

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertNotEquals($response->getContent(), '');
        $this->assertNotEquals($response->getSize(), 0);
    }

}