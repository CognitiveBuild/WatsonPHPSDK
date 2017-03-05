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
use WatsonSDK\Common\HttpClientException;

use PHPUnit\Framework\TestCase;

final class HttpClientTest extends TestCase {

    public function testHttpClientConfigurationDefaultValues() {

        $config = new HttpClientConfiguration();

        $this->assertInstanceOf(
            HttpClientConfiguration::class, 
            $config
        );

        // Test default settings
        $this->assertEquals($config->getMethod(), 'GET');
        $this->assertNull($config->getURL());
        $this->assertEquals($config->getTimeout(), 0);
        $this->assertNull($config->getType());
        $this->assertEquals($config->getQuery(), []);
        $this->assertEquals($config->getHeader(), []);
        $this->assertEquals($config->getData(), []);
        $this->assertEquals($config->toOptions(), []);
        // 
        $config->setCredentials([ 'username', 'password' ]);
        $this->assertEquals($config->toOptions(), [ 'auth' => [ 'username', 'password' ] ]);
        // 
        $config->setData([ 'key' => 'value' ]);
        $this->assertEquals($config->getData(), [ 'key' => 'value' ]);
        // 
        $config->setQuery([ 'p' => 'q' ]);
        $this->assertEquals($config->getQuery(), [ 'p' => 'q' ]);
        //
        $config->setHeader([ 'p' => 'q' ]);
        $this->assertEquals($config->getHeader(), [ 'p' => 'q' ]);
        // 
        $config->setTimeout(20000);
        $this->assertEquals($config->getTimeout(), 20000);
        // 
        $config->setURL('https://phpsdk.mybluemix.net/');
        $this->assertEquals($config->getURL(), 'https://phpsdk.mybluemix.net/');
        //
        $config->setType(HttpClientConfiguration::DATA_TYPE_FORM);
        $this->assertEquals($config->getType(), 'form_params');
        //
        $this->assertEquals($config->toOptions(), [ 'form_params' => [ 'key' => 'value' ], 'query' => [ 'p' => 'q' ], 
        'headers' => [ 'p' => 'q' ], 'auth' => [ 'username', 'password' ], 'timeout' => 20000 ]);
    }

    // 
    public function testHttpClientRequest() {

        $httpClient = new HttpClient();
        $config = new HttpClientConfiguration();
        $config->setURL('https://phpsdk.mybluemix.net/');

        $this->assertInstanceOf(
            HttpClient::class, 
            $httpClient
        );

        $response = $httpClient->request($config);

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertNotEquals($response->getContent(), '');
        $this->assertNotEquals($response->getSize(), 0);

        try {
            $response = $httpClient->request(new HttpClientConfiguration('https://phpsdk.mybluemix.net/404.php'));
        }
        catch (HttpClientException $ex) {
            $this->assertEquals($ex->getCode(), 404);
            $this->assertNotEquals($ex->getMessage(), '');
        }
    }

}