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

namespace WatsonSDK\Services;

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpResponse;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;
use WatsonSDK\Common\WatsonService;
use WatsonSDK\Common\WatsonCredential;

/**
 * Natural Language Classifier class
 */
class NaturalLanguageClassifier extends WatsonService {

    /**
     * Constructor
     * 
     * @param $credential WatsonCredential
     */
    function __construct(WatsonCredential $credential) {

        parent::__construct($credential);
    }

    /**
     * Sends data to create and train a classifier and returns information about the new classifier.
     */
    public function CreateClassifier($training_file, $language = NaturalLanguageClassifierModel::LANGUAGE_EN, $name = '') {

        $this->_httpConfig->setData([ 'training_data' => $training_file, 'training_metadata' => [ 'language' => $language, 'name' => $name ] ]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_POST);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_MULTIPART);
        $this->_httpConfig->setURL(NaturalLanguageClassifierModel::BASE_URL."/classifiers");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }

    /**
     * Retrieves the list of classifiers for the service instance. Returns an empty array if no classifiers are available.
     * 
     * @return HttpResponse
     */
    public function ListClassifiers() {

        $this->_httpConfig->setData([]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_GET);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(NaturalLanguageClassifierModel::BASE_URL."/classifiers");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }

    /**
     * Returns status and other information about a classifier
     * 
     * @return HttpResponse
     */
    public function GetClassifier($classifier_id) {

        $this->_httpConfig->setData([]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_GET);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(NaturalLanguageClassifierModel::BASE_URL."/classifiers/{$classifier_id}");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }

    /**
     * Deletes a classifier.
     */
    public function DeleteClassifier($classifier_id) {

        $this->_httpConfig->setData([]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_DELETE);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(NaturalLanguageClassifierModel::BASE_URL."/classifiers/{$classifier_id}");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }

    /**
     * Returns label information for the input. 
     * The status must be "Available" before you can classify calls. 
     * Use the Get information about a classifier method to retrieve the status. 
     */
    public function Classify($text, $classifier_id) {

        $this->_httpConfig->setData([ 'text' => $text ]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_POST);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(NaturalLanguageClassifierModel::BASE_URL."/{$classifier_id}/classify");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }
}