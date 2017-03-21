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

use WatsonSDK\Services\NaturalLanguageUnderstanding;
use WatsonSDK\Services\NaturalLanguageUnderstanding\AnalyzeModel;

final class NaturalLanguageUnderstandingTest extends BaseTestCase {

    /**
     * AnalyzeModel unit test
     */
    public function testAnalyzeModel () {

        $model = new AnalyzeModel('http://php-sdk.migg.cn/', [ 'entities' => [ 'limit' => 10 ], 'keywords' => [ 'limit' => 10 ] ], AnalyzeModel::TYPE_URL);

        $this->assertInstanceOf(
            AnalyzeModel::class, 
            $model
        );

        $this->assertEquals($model->getContents(), [ AnalyzeModel::TYPE_URL => 'http://php-sdk.migg.cn/' ]);
        $this->assertEquals($model->getFeatures(), [ 'entities' => [ 'limit' => 10 ], 'keywords' => [ 'limit' => 10 ] ]);

        $model->setContents(AnalyzeModel::TYPE_TEXT, 'Hello World!');
        $model->setFeatures( [ 'entities' => [ 'limit' => 5 ] ] );
        $model->setLanguage('fr');
        $model->setClean(TRUE);
        $model->setFallbackToRaw(TRUE);
        $model->setReturnAnalyzedText(TRUE);
        $model->setVersion('new-version');

        $this->assertEquals($model->getFeatures(), [ 'entities' => [ 'limit' => 5 ] ]);
        $this->assertEquals($model->getLanguage(), 'fr');
        $this->assertEquals($model->getVersion(), 'new-version');

        $this->assertEquals($model->getClean(), TRUE);
        $this->assertEquals($model->getReturnAnalyzedText(), TRUE);
        $this->assertEquals($model->getFallbackToRaw(), TRUE);

        $this->assertEquals($model->getData('@data'), [
            'language' => 'fr', 
            'clean' => TRUE, 
            'fallback_to_raw' => TRUE, 
            'return_analyzed_text' => TRUE, 
            'features' => [ 'entities' => [ 'limit' => 5 ] ], 
            'text' => 'Hello World!'
        ]);

        $this->assertEquals($model->getData('@query'), [
            'version' => 'new-version'
        ]);

    }

    /**
     * NaturalLanguageUnderstanding unit test with basic authentication
     */
    public function testNaturalLanguageUnderstanding() {

        $username = getenv('NATURAL_LANGUAGE_UNDERSTANDING_USERNAME');
        $password = getenv('NATURAL_LANGUAGE_UNDERSTANDING_PASSWORD');

        if(isset($username) && isset($password)) {
            $nlu = new NaturalLanguageUnderstanding(WatsonCredential::initWithCredentials($username, $password));

            $this->assertInstanceOf(
                NaturalLanguageUnderstanding::class, 
                $nlu
            );

            $models = $nlu->listModels();
            $this->assertEquals(200, $models->getStatusCode());

            $model = new AnalyzeModel('Watson PHP SDK for IBM Watson Developer Cloud.', [ 'keywords' => [ 'limit' => 5 ] ]);
            $result = $nlu->analyze($model);
            $this->assertEquals(200, $result->getStatusCode());
        }
    }

    /**
     * NaturalLanguageUnderstanding unit test for handling error response from analyze method
     */
    public function testNaturalLanguageUnderstandingResponseError() {

        $username = getenv('NATURAL_LANGUAGE_UNDERSTANDING_USERNAME');
        $password = getenv('NATURAL_LANGUAGE_UNDERSTANDING_PASSWORD');

        if(isset($username) && isset($password)) {
            $nlu = new NaturalLanguageUnderstanding(WatsonCredential::initWithCredentials($username, $password));

            $model = new AnalyzeModel('Watson PHP SDK for IBM Watson Developer Cloud.', [ ]);
            $result = $nlu->analyze($model);
            $this->assertEquals(400, $result->getStatusCode());
        }
    }

    /**
     * NaturalLanguageUnderstanding unit test for handling error response from listModels method
     */
    public function testNaturalLanguageUnderstandingListModelsResponseError() {

        $nlu = new NaturalLanguageUnderstanding(WatsonCredential::initWithCredentials('invalid-username', 'invalid-password'));
        $result = $nlu->listModels();
        $this->assertEquals(401, $result->getStatusCode());
    }
}