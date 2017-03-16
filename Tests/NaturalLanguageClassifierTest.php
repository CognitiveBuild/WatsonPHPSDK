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

use WatsonSDK\Services\NaturalLanguageClassifier;
use WatsonSDK\Services\NaturalLanguageClassifierModel;

use PHPUnit\Framework\TestCase;

final class NaturalLanguageClassifierTest extends TestCase {

    protected function setUp() {

        $env = new Environment(__DIR__);
        $env->load();
    }

    /**
     * NaturalLanguageClassifierModel unit test
     */
    public function testNaturalLanguageClassifierModel () {

        $model = new NaturalLanguageClassifierModel();

        $this->assertInstanceOf(
            NaturalLanguageClassifierModel::class, 
            $model
        );
    }

    /**
     * NaturalLanguageClassifier unit test with basic authentication
     */
    // public function testNaturalLanguageClassifier() {

    //     $username = getenv('NATURAL_LANGUAGE_CLASSIFIER_USERNAME');
    //     $password = getenv('NATURAL_LANGUAGE_CLASSIFIER_PASSWORD');

    //     $nlc = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials($username, $password));

    //     $this->assertInstanceOf(
    //         NaturalLanguageClassifier::class, 
    //         $nlc
    //     );

    //     if(isset($username) && isset($password)) {

    //         $classifier_name = 'Test';
    //         $training_file = file_get_contents(__DIR__ . './../Tests/Data/NaturalLanguageClassifier.csv');
    //         $result = $nlc->createClassifier($training_file, NaturalLanguageClassifierModel::LANGUAGE_EN, $classifier_name);

    //         print_r($result);

    //         $content = json_decode($result->getContent(), true);
    //         $classifier_id = $content['classifier_id'];

    //         $classifier = $nlc->getClassifier($classifier_id);
    //         $this->assertEquals(200, $classifier->getStatusCode());

    //         $classifiers = $nlc->listClassifiers();
    //         $this->assertEquals(200, $classifiers->getStatusCode());

    //         // go forward,locomotion_forward
    //         $result = $nlc->classify('go forward', $classifier_id);
    //         $this->assertEquals(200, $result->getStatusCode());

    //         $delete = $nlc->deleteClassifier($classifier_id);
    //         $this->assertEquals(200, $delete->getStatusCode());
    //     }
    // }

    /**
     * NaturalLanguageClassifier unit test for handling error response from classify method
     */
    public function testNaturalLanguageClassifierClassifyResponseError() {

        $nlc = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials('invalid-username', 'invalid-password'));

        $result = $nlc->classify('go forward', 'fake-id');
        $this->assertEquals(401, $result->getStatusCode());
    }

    /**
     * NaturalLanguageClassifier unit test for handling error response from getClassifier method
     */
    public function testNaturalLanguageClassifierGetClassifierResponseError() {

        $nlu = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials('invalid-username', 'invalid-password'));
        $result = $nlu->getClassifier('fake-id');
        $this->assertEquals(401, $result->getStatusCode());
    }
}