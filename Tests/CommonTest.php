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

use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\SimpleTokenProvider;

final class CommonTest extends BaseTestCase {

    /**
     * SimpleTokenProvider unit test
     */
    public function testSimpleTokenProvider () {

        $provider = new SimpleTokenProvider('https://your-token-factory-url');

        $this->assertInstanceOf(
            SimpleTokenProvider::class,
            $provider
        );

        $this->assertEquals($provider->getToken(), NULL);
    }

    /**
     * WatsonCredential unit test
     */
    public function testWatsonCredential() {

        $credential = new WatsonCredential();
        $credential->setUsername('u');
        $credential->setPassword('p');
        $credential->setToken('t');

        $provider = new SimpleTokenProvider('https://your-token-factory-url');
        $credential->setTokenProvider($provider);

        $this->assertInstanceOf(
            WatsonCredential::class, 
            $credential
        );

        $this->assertEquals($credential->getUsername(), 'u');
        $this->assertEquals($credential->getPassword(), 'p');
        $this->assertEquals($credential->getToken(), 't');
        $this->assertEquals($credential->getTokenProvider(), $provider);
    }
}