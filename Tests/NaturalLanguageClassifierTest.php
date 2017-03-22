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

final class NaturalLanguageClassifierTest extends BaseTestCase {

    /**
     * NaturalLanguageClassifier unit test with basic authentication
     */
    public function testNaturalLanguageClassifier() {

        $username = getenv('NATURAL_LANGUAGE_CLASSIFIER_USERNAME');
        $password = getenv('NATURAL_LANGUAGE_CLASSIFIER_PASSWORD');
        $classified_id = getenv('NATURAL_LANGUAGE_CLASSIFIER_CLASSIFIER');

        $nlc = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials($username, $password), TRUE);

        $this->assertInstanceOf(
            NaturalLanguageClassifier::class, 
            $nlc
        );

        if(isset($username) && isset($password)) {

            $classifier_name = 'Unit Test';
            $training_file_path = 'http://php-sdk.migg.cn/data/NaturalLanguageClassifier.csv';
            $result = $nlc->createClassifier($training_file_path, NaturalLanguageClassifier::LANGUAGE_EN, $classifier_name);

            $content = json_decode($result->getContent(), true);

            $classifier_id = $content['classifier_id'];

            $classifier = $nlc->getClassifier($classifier_id);
            $this->assertEquals(200, $classifier->getStatusCode());

            $classifiers = $nlc->listClassifiers();
            $this->assertEquals(200, $classifiers->getStatusCode());

            // go forward,locomotion_forward
            $result = $nlc->classify('Go forward', $classifier_id);
            $this->assertEquals(404, $result->getStatusCode()); // not yet trained
            $result = $nlc->classify('How are you', $classified_id); // trained
        }
    }

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

        $username = getenv('NATURAL_LANGUAGE_CLASSIFIER_USERNAME');
        $password = getenv('NATURAL_LANGUAGE_CLASSIFIER_PASSWORD');

        $nlc = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials($username, $password));

        $result = $nlc->getClassifier('fake-id');
        $this->assertEquals(404, $result->getStatusCode());
    }

    /**
     * NaturalLanguageClassifier unit test for handling error response from getClassifier method
     */
    public function testNaturalLanguageClassifierCreateClassifierResponseError() {

        $username = getenv('NATURAL_LANGUAGE_CLASSIFIER_USERNAME');
        $password = getenv('NATURAL_LANGUAGE_CLASSIFIER_PASSWORD');

        $nlc = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials($username, $password));

        $training_file_path = 'http://php-sdk.migg.cn/data/NaturalLanguageClassifier.Empty.csv';
        $result = $nlc->createClassifier($training_file_path, NaturalLanguageClassifier::LANGUAGE_EN);
        $this->assertEquals(400, $result->getStatusCode());
    }

    /**
     * NaturalLanguageClassifier unit test for handling error response from listClassifiers method
     */
    public function testNaturalLanguageClassifierListClassifiersResponseError() {

        $nlc = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials('invalid-username', 'invalid-password'));

        $result = $nlc->listClassifiers();
        $this->assertEquals(401, $result->getStatusCode());
    }

    /**
     * NaturalLanguageClassifier unit test for handling error response from deleteClassifier method
     */
    public function testNaturalLanguageClassifierDeleteClassifierResponseError() {

        $username = getenv('NATURAL_LANGUAGE_CLASSIFIER_USERNAME');
        $password = getenv('NATURAL_LANGUAGE_CLASSIFIER_PASSWORD');

        $nlc = new NaturalLanguageClassifier(WatsonCredential::initWithCredentials($username, $password));

        $result = $nlc->deleteClassifier('fake-id');
        $this->assertEquals(404, $result->getStatusCode());
    }
}