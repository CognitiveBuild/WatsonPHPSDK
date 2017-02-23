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
use WatsonSDK\Common\HttpResponse;
use WatsonSDK\Common\HttpClientException;

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

    /**
     * @dataProvider toneWithBasicAuthProvider
     */
    public function testToneAnalyzer($Username,$Password,$Statuscode,$Text='Im so happy') {
        $analyzer = new ToneAnalyzer();
        $model    = new ToneAnalyzerModel();

        $this->assertInstanceOf(
            ToneAnalyzer::class,
            $analyzer
        );
        $model->setUsername($Username);
        $model->setPassword($Password);

        $model->setText($Text);

        $result = $analyzer->Tone($model);
        $this->assertEquals($Statuscode,$result->getStatusCode());
    }

    public function testTone() {
        $analyzer = new ToneAnalyzer();
        $model    = new ToneAnalyzerModel();

        $this->assertInstanceOf(
            ToneAnalyzer::class,
            $analyzer
        );
        $model->setUsername(getenv('TONE_ANALYZER_USERNAME'));
        $model->setPassword(getenv('TONE_ANALYZER_PASSWORD'));

        $model->setText('I am so happy!');

        $result = $analyzer->Tone($model);
        return $result;

    }


    /**
     * @depends testTone
     */
    public function testResponseAttribute(){
        $this->assertObjectHasAttribute('_content',func_get_args()[0]);
        $this->assertObjectHasAttribute('_status_code',func_get_args()[0]);
        $this->assertObjectHasAttribute('_size',func_get_args()[0]);
    }


    /**
     * @depends testTone
     */
    public function testStatus(){
        $this->assertObjectHasAttribute('_content',func_get_args()[0]);
        $this->assertObjectHasAttribute('_status_code',func_get_args()[0]);
        $this->assertObjectHasAttribute('_size',func_get_args()[0]);
    }

    /**
     * @dataProvider toneWithTokenProvider
     */
    public function testToneWithTokenProvider($Token,$Statuscode,$Text='I feel so happy') {
        $analyzer = new ToneAnalyzer();
        $model    = new ToneAnalyzerModel();

        $this->assertInstanceOf(
            ToneAnalyzer::class,
            $analyzer
        );
        $tokenProvider=new SimpleTokenProvider('http://www.baidu.com');
        $tokenProvider->setToken($Token);
         $model->setTokenProvider($tokenProvider);
        $model->setText($Text);

        $result = $analyzer->Tone($model);

        $this->assertEquals($Statuscode,$result->getStatusCode());
    }

    public function toneWithBasicAuthProvider()
    {
        $Username=getenv('TONE_ANALYZER_USERNAME');
        $Password=getenv('TONE_ANALYZER_PASSWORD');
        return [
            [$Username, $Password, 200],
            [$Username, $Password,400,''],
            ['username', $Password, 401],
            [$Username, 'password', 401],
            ['username', 'password', 401],
            ['', $Password, 401],
            [$Username,'', 401],
            ['','', 401]
        ];
    }

    public function toneWithTokenProvider()
    {
        $validToken=getenv('TONE_ANALYZER_TOKEN');
        $invalidToken='token';
        return [
            'case0'=>[$validToken, 200],
            'case1'=>[$validToken,400,''],
            'case2'=>[$invalidToken,403],
            'case3'=>[$invalidToken,403,''],
            'case4'=>['',401],
            'case5'=>['',401,''],
        ];
    }
}