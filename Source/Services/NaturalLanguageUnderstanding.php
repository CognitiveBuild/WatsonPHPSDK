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

use WatsonSDK\Services\NaturalLanguageUnderstanding\AnalyzeModel;

/**
 * Natural Language Understanding class
 */
class NaturalLanguageUnderstanding extends WatsonService {

    const BASE_URL = 'https://gateway.watsonplatform.net/natural-language-understanding/api/v1';

    /**
     * Analyze features of natural language content.
     * 
     * @param $model AnalyzeModel
     * @return HttpResponse
     */
    public function analyze(AnalyzeModel $model) {

        $config = $this->initConfig();

        $config->setData($model->getData('@data'));
        $config->setQuery($model->getData('@query'));
        $config->addHeaders($model->getData('@header'));

        $config->setMethod(HttpClientConfiguration::METHOD_POST);
        $config->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $config->setURL(self::BASE_URL.'/analyze');

        return $this->sendRequest($config);
    }

    /**
     * List available custom models
     * 
     * @param $version string
     * @return HttpResponse
     */
    public function listModels() {

        $config = $this->initConfig($version = AnalyzeModel::VERSION);

        $config->setQuery( [ 'version' => $version ] );

        $config->setMethod(HttpClientConfiguration::METHOD_GET);
        $config->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $config->setURL(self::BASE_URL."/models");

        return $this->sendRequest($config);
    }

    /**
     * Delete a custom model
     * 
     * @codeCoverageIgnore
     * 
     * @param $model_id string
     * @param $version string
     * @return HttpResponse
     */
    public function deleteModels($model_id, $version = AnalyzeModel::VERSION) {

        $config = $this->initConfig();
        $config->setQuery( [ 'version' => $version ] );

        $config->setMethod(HttpClientConfiguration::METHOD_DELETE);
        $config->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $config->setURL(self::BASE_URL."/models/{$model_id}");

        return $this->sendRequest($config);
    }
}