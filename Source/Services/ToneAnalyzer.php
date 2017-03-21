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
use WatsonSDK\Common\InvalidParameterException;
use WatsonSDK\Common\WatsonService;
use WatsonSDK\Common\WatsonCredential;

use WatsonSDK\Services\ToneAnalyzer\ToneModel;

/**
 * Tone Analyzer class
 */
class ToneAnalyzer extends WatsonService {

    /**
     * Constructor
     * 
     * @param $credential WatsonCredential
     */
    function __construct(WatsonCredential $credential) {

        parent::__construct($credential);
    }

    /**
     * Analyzes the tone of a piece of text. 
     * The message is analyzed for several tones - social, emotional, and language. 
     * For each tone, various traits are derived. For example, conscientiousness, agreeableness, and openness.
     * 
     * @param $model ToneModel
     * 
     * @return HttpResponse
     */
    private function getToneByModel(ToneModel $model) {

        $this->_httpConfig->setData($model->getData('@data'));
        $this->_httpConfig->setQuery($model->getData('@query'));

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_POST);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(ToneModel::BASE_URL."/tone");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }

    /**
     * Analyzes the tone of a piece of text. 
     * The message is analyzed for several tones - social, emotional, and language. 
     * For each tone, various traits are derived. For example, conscientiousness, agreeableness, and openness.
     * 
     * @param $text string
     * 
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
        else if(is_string($val)) {
            return $this->getToneByText($val);
        }
        else {
            throw new InvalidParameterException();
        }
    }
}
