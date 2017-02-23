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

use WatsonSDK\Common\TokenProviderInterface;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Services\ToneAnalyzer;
use WatsonSDK\Services\ToneAnalyzerModel;

use PHPUnit\Framework\TestCase;

class ToneAnalyzerTest extends TestCase {

    public function testToneAnalyzerTokenProvider () {

        $provider = new SimpleTokenProvider('https://your-token-factory-url');

        $this->assertInstanceOf(
            SimpleTokenProvider::class, 
            $provider
        );

        $this->assertEquals($provider->getToken(), NULL);
    }

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

        $this->assertEquals($model->getUsername(), 'u');
        $this->assertEquals($model->getPassword(), 'p');
        $this->assertEquals($model->getText(), 't');

        $this->assertEquals($model->getTokenProvider(), $provider);

    }

    public function testToneAnalyzer() {

        $analyzer = new ToneAnalyzer();
        $model    = new ToneAnalyzerModel();

        $this->assertInstanceOf(
            ToneAnalyzer::class, 
            $analyzer
        );

        print_r($_ENV);

        $username = getenv('TONE_ANALYZER_USERNAME');
        $password = getenv('TONE_ANALYZER_PASSWORD');
        $model->setUsername($username);
        $model->setPassword($password);

        // $model->setTokenProvider( new SimpleTokenProvider('https://your-token-factory-url') );
        $model->setText('I am so happy!');

        $result = $analyzer->Tone($model);

        print_r($result);
    }
}