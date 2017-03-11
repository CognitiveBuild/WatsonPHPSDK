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
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\InvalidParameterException;

use WatsonSDK\Services\ToneAnalyzer;
use WatsonSDK\Services\ToneAnalyzerModel;

use PHPUnit\Framework\TestCase;

final class ToneAnalyzerTest extends TestCase {

    protected function setUp() {

        $env = new Environment(__DIR__);
        $env->load();
    }

    /**
     * ToneAnalyzerModel unit test
     */
    public function testToneAnalyzerModel () {

        $model = new ToneAnalyzerModel();

        $this->assertInstanceOf(
            ToneAnalyzerModel::class, 
            $model
        );

        $model->setText('t');
        $model->setTones('e');
        $model->setSentences(TRUE);
        $model->setVersion('new-version');

        $this->assertEquals($model->getVersion(), 'new-version');
        $this->assertEquals($model->getText(), 't');
        $this->assertEquals($model->getTones(), 'e');
        $this->assertEquals($model->getSentences(), TRUE);

        $this->assertEquals($model->getData('@query'), [
            'tones' => 'e',
            'version' => 'new-version',
            'sentences' => TRUE
        ]);

        $this->assertEquals($model->getData('@data'), [
            'text' => 't'
        ]);

    }

    /**
     * ToneAnalyzer unit test with basic authentication
     */
    public function testToneAnalyzer() {

        $username = getenv('TONE_ANALYZER_USERNAME');
        $password = getenv('TONE_ANALYZER_PASSWORD');

        $analyzer = new ToneAnalyzer(WatsonCredential::initWithCredentials($username, $password));
        $model    = new ToneAnalyzerModel();

        $this->assertInstanceOf(
            ToneAnalyzer::class, 
            $analyzer
        );

        $model->setText('I am so happy!');
        $model->setTones('social');

        if(isset($username) && isset($password)) {
            $result = $analyzer->Tone($model);
            $this->assertEquals(200, $result->getStatusCode());
        }
    }

    /**
     * Unit Test for invalid parameters of SimpleTokenProvider
     */ 
    public function testTokenProviderException() {

        $this->expectException(InvalidParameterException::class);
        $provider = new SimpleTokenProvider();
    }

    /**
     * Unit Test for invalid token
     */ 
    public function testTokenProvider() {

        $provider = new SimpleTokenProvider('https://phpsdk.mybluemix.net/invalidToken.php');
        $analyzer = new ToneAnalyzer(WatsonCredential::initWithTokenProvider($provider));

        $model = new ToneAnalyzerModel();
        $model->setText('This is a test.');
        $result = $analyzer->Tone($model);

        $this->assertEquals($result->getStatusCode(), 403);
    }

    /**
     * Unit Test for ToneAnalzyer with Token Provider
     */ 
    public function testToneWithTokenProvider() {

        $username = getenv('TONE_ANALYZER_USERNAME');
        $password = getenv('TONE_ANALYZER_PASSWORD');

        $token = $this->getToken($username, $password);

        $provider = new SimpleTokenProvider(NULL, $token);
        $analyzer = new ToneAnalyzer(WatsonCredential::initWithTokenProvider($provider));

        $model = new ToneAnalyzerModel();
        $model->setText('I feel so happy');

        $result = $analyzer->Tone($model);

        $this->assertEquals(200, $result->getStatusCode());
    }

    /**
     * Request a new token
     */ 
    private function getToken($username, $password) {

        $serviceUrl = ToneAnalyzerModel::BASE_URL.'/analyze?version='.ToneAnalyzerModel::VERSION;

        return SimpleTokenHelper::requestToken($username, $password, $serviceUrl);
    }

}