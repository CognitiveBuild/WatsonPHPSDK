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

    const BASE_URL = 'https://gateway.watsonplatform.net/natural-language-classifier/api/v1';

    const LANGUAGE_EN = 'en';
    const LANGUAGE_AR = 'ar';
    const LANGUAGE_FR = 'fr';
    const LANGUAGE_DE = 'de';
    const LANGUAGE_IT = 'it';
    const LANGUAGE_JA = 'ja';
    const LANGUAGE_PT = 'pt';
    const LANGUAGE_ES = 'es';

    /**
     * Sends data to create and train a classifier and returns information about the new classifier.
     * 
     * @param $training_file Resource
     * @param $language string
     * @param $name string | NULL
     * @return HttpResponse
     */
    public function createClassifier($training_file_path, $language = self::LANGUAGE_EN, $name = NULL) {

        $training_data_file = fopen($training_file_path, 'r');
        $training_metadata_file = tmpfile();

        fwrite($training_metadata_file, json_encode([ 'language' => $language ]));

        if(is_null($name) === FALSE && strlen($name) > 0) {
            fwrite($training_metadata_file, json_encode([ 'name' => $name ]));
        }

        $data = [
            [
                'name' => 'training_data', 
                'contents' => $training_data_file
            ], 
            [
                'name' => 'training_metadata', 
                'contents' => $training_metadata_file
            ]
        ];

        $this->_httpConfig->setData($data);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_POST);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_MULTIPART);
        $this->_httpConfig->setURL(self::BASE_URL."/classifiers");

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
    public function listClassifiers() {

        $this->_httpConfig->setData([]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_GET);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(self::BASE_URL."/classifiers");

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
     * @param $classifier_id string 
     * @return HttpResponse
     */
    public function getClassifier($classifier_id) {

        $this->_httpConfig->setData([]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_GET);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(self::BASE_URL."/classifiers/{$classifier_id}");

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
     * 
     * @codeCoverageIgnore
     * 
     * @param $classifier_id string 
     * @return HttpResponse
     */
    public function deleteClassifier($classifier_id) {

        $this->_httpConfig->setData([]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_DELETE);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(self::BASE_URL."/classifiers/{$classifier_id}");

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
     * 
     * @param $text string 
     * @param $classifier_id string
     * 
     * @return HttpResponse
     */
    public function classify($text, $classifier_id) {

        $this->_httpConfig->setData([ 'text' => $text ]);

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_POST);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(self::BASE_URL."/{$classifier_id}/classify");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }
}