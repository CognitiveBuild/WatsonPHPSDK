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

final class HttpClientTest extends BaseTestCase {

    /**
     * HttpClientConfiguration unit test
     */
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
        $this->assertEquals($config->getConnectionTimeout(), 0);
        $this->assertNull($config->getType());
        $this->assertEquals($config->getQuery(), []);
        $this->assertEquals($config->getHeaders(), []);
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
        $config->setHeaders([ 'p' => 'q' ]);
        $this->assertEquals($config->getHeaders(), [ 'p' => 'q' ]);
        $config->addHeaders([ 'x' => 'y' ]);
        $this->assertEquals($config->getHeaders(), [ 'p' => 'q', 'x' => 'y' ]);
        // 
        $config->setTimeout(20);
        $this->assertEquals($config->getTimeout(), 20);
        // 
        $config->setConnectionTimeout(3.14);
        $this->assertEquals($config->getConnectionTimeout(), 3.14);
        // 
        $config->setURL('http://php-sdk.migg.cn/');
        $this->assertEquals($config->getURL(), 'http://php-sdk.migg.cn/');
        //
        $config->setType(HttpClientConfiguration::DATA_TYPE_FORM);
        $this->assertEquals($config->getType(), 'form_params');
        //
        $this->assertEquals($config->toOptions(), [ 'form_params' => [ 'key' => 'value' ], 'query' => [ 'p' => 'q' ], 'headers' => [ 'p' => 'q', 'x' => 'y' ], 'auth' => [ 'username', 'password' ], 'timeout' => 20, 'connect_timeout' => 3.14 ]);
    }

    // HttpClient unit test
    public function testHttpClientRequest() {

        $httpClient = new HttpClient();
        $config = new HttpClientConfiguration();
        $config->setURL('http://php-sdk.migg.cn/');

        $this->assertInstanceOf(
            HttpClient::class, 
            $httpClient
        );

        $response = $httpClient->request($config);

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertNotEquals($response->getContent(), '');
        $this->assertNotEquals($response->getSize(), 0);

        try {
            $response = $httpClient->request(new HttpClientConfiguration('http://php-sdk.migg.cn/404.php'));
        }
        catch (HttpClientException $ex) {
            $this->assertEquals($ex->getCode(), 404);
            $this->assertNotEquals($ex->getMessage(), '');
        }
    }

}