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
use WatsonSDK\Common\InvalidParameterException;

use WatsonSDK\Services\ToneAnalyzer\ToneModel;

/**
 * Tone Analyzer class
 */
class ToneAnalyzer extends WatsonService {

    const BASE_URL = 'https://gateway.watsonplatform.net/tone-analyzer/api/v3';

    /**
     * Analyzes the tone of a piece of text. 
     * The message is analyzed for several tones - social, emotional, and language. 
     * For each tone, various traits are derived. For example, conscientiousness, agreeableness, and openness.
     * 
     * @param $model ToneModel
     * @return HttpResponse
     */
    private function getToneByModel(ToneModel $model) {

        $config = $this->initConfig();

        $config->setData($model->getData('@data'));
        $config->setQuery($model->getData('@query'));

        $config->setMethod(HttpClientConfiguration::METHOD_POST);
        $config->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $config->setURL(self::BASE_URL."/tone");

        return $this->sendRequest($config);
    }

    /**
     * Analyzes the tone of a piece of text. 
     * The message is analyzed for several tones - social, emotional, and language. 
     * For each tone, various traits are derived. For example, conscientiousness, agreeableness, and openness.
     * 
     * @param $text string
     * @return HttpResponse
     */
    private function getToneByText($text) {

        $model = new ToneModel($text);
        return $this->getToneByModel($model);
    }

    /**
     * Analyzes the tone of a piece of text. 
     * The message is analyzed for several tones - social, emotional, and language. 
     * For each tone, various traits are derived. For example, conscientiousness, agreeableness, and openness.
     * 
     * @param $val mix
     * 
     * @return HttpResponse
     * @throws InvalidParameterException
     */
    public function getTone($val) {

        if($val instanceof ToneModel) {
            return $this->getToneByModel($val);
        }

        if(is_string($val)) {
            return $this->getToneByText($val);
        }

        throw new InvalidParameterException();
    }
}
