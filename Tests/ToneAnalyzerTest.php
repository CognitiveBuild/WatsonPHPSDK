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
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Common\SimpleTokenHelper;

use WatsonSDK\Services\ToneAnalyzer;
use WatsonSDK\Services\ToneAnalyzerModel;

use PHPUnit\Framework\TestCase;

class ToneAnalyzerTest extends TestCase {

    protected function setUp() {
        $env = new Environment(__DIR__);
        $env->load();
    }

    /**
     * ToneAnalyzerTokenProvider unit test
     */
    public function testToneAnalyzerTokenProvider () {

        $provider = new SimpleTokenProvider('https://your-token-factory-url');

        $this->assertInstanceOf(
            SimpleTokenProvider::class,
            $provider
        );

        $this->assertEquals($provider->getToken(), NULL);
    }

    /**
     * ToneAnalyzerModel unit test
     */
    public function testToneAnalyzerModel () {

        $model    = new ToneAnalyzerModel();
        $provider = new SimpleTokenProvider('https://your-token-factory-url');

        $this->assertInstanceOf(
            ToneAnalyzerModel::class,
            $model
        );

        $this->assertInstanceOf(
            ToneAnalyzerModel::class,
            $model
        );

        $model->setUsername('u');
        $model->setPassword('p');
        $model->setText('t');
        $model->setTokenProvider($provider);
        $model->setTones('e');
        $model->setSentences(true);

        $this->assertEquals($model->getUsername(), 'u');
        $this->assertEquals($model->getPassword(), 'p');
        $this->assertEquals($model->getText(), 't');
        $this->assertEquals($model->getTokenProvider(), $provider);
        $this->assertEquals($model->getTones(),'e');
        $this->assertEquals($model->getSentences(), true);
    }

    /**
     * ToneAnalyzer unit test with basic authentication
     */
    public function testToneAnalyzer() {
        $analyzer = new ToneAnalyzer();
        $model    = new ToneAnalyzerModel();

        $this->assertInstanceOf(
            ToneAnalyzer::class,
            $analyzer
        );

        $username = getenv('TONE_ANALYZER_USERNAME');
        $password = getenv('TONE_ANALYZER_PASSWORD');

        $model->setUsername($username);
        $model->setPassword($password);

        $model->setText('I am so happy!');
        $model->setTones('social');

        if(isset($username) && isset($password)) {
            $result = $analyzer->Tone($model);
            $this->assertEquals(200, $result->getStatusCode());
            // @todo: evaluate $result->getContent();
        }
    }

    public function testToneWithTokenProvider() {
        $analyzer = new ToneAnalyzer();
        $model    = new ToneAnalyzerModel();
        $tokenProvider = new SimpleTokenProvider('');

        $username = getenv('TONE_ANALYZER_USERNAME');
        $password = getenv('TONE_ANALYZER_PASSWORD');

        try {
            $token = $this->getToken($username, $password);
            $tokenProvider->setToken($token);
            $model->setTokenProvider($tokenProvider);
            $model->setText('I feel so happy');

            $result = $analyzer->Tone($model);

            $this->assertEquals(200, $result->getStatusCode());
        }
        catch(HttpClientException $ex) {
            
        }
    }

    /**
     * Request a new token
     */ 
    private function getToken($username, $password) {

        $serviceUrl = 'https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone?version=2016-05-19';

        return SimpleTokenHelper::requestToken($username, $password, $serviceUrl);
    }

}