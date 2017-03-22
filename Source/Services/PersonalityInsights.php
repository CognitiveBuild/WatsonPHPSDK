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

use WatsonSDK\Services\PersonalityInsights\ProfileModel;
use WatsonSDK\Services\PersonalityInsights\ContentItemModel;

/**
 * Personality Insights class
 */
class PersonalityInsights extends WatsonService {

    /**
     * Generates a personality profile for the author of the input text. 
     * The service accepts a maximum of 20 MB of input content. 
     * It can analyze text in Arabic, English, Japanese, or Spanish and return its results in a variety of languages. 
     * You can provide plain text, HTML, or JSON input. 
     * The service returns output in JSON format by default, but you can request the output in CSV format. 
     * 
     * @param $model ProfileModel
     * 
     * @return HttpResponse
     */
    private function getProfileByModel(ProfileModel $model) {

        $this->_httpConfig->setData($model->getData('@data'));
        $this->_httpConfig->setQuery($model->getData('@query'));
        $this->_httpConfig->addHeaders($model->getData('@header'));

        $this->_httpConfig->setMethod(HttpClientConfiguration::METHOD_POST);
        $this->_httpConfig->setType(HttpClientConfiguration::DATA_TYPE_JSON);
        $this->_httpConfig->setURL(ProfileModel::BASE_URL."/profile");

        try {
            return $this->_httpClient->request($this->_httpConfig);
        }
        catch(HttpClientException $ex) {
            $response = new HttpResponse($ex->getCode(), $ex->getMessage());
            return $response;
        }
    }

    /**
     * Generates a personality profile for the author of the input text. 
     * The service accepts a maximum of 20 MB of input content. 
     * It can analyze text in Arabic, English, Japanese, or Spanish and return its results in a variety of languages. 
     * You can provide plain text, HTML, or JSON input. 
     * The service returns output in JSON format by default, but you can request the output in CSV format. 
     * 
     * @param $text string
     * 
     * @return HttpResponse
     */
    private function getProfileByText($text) {

        $content = new ContentItemModel($text);
        $model = new ProfileModel($content);
        return $this->getProfileByModel($model);
    }

    /**
     * Generates a personality profile for the author of the input text. 
     * The service accepts a maximum of 20 MB of input content. 
     * It can analyze text in Arabic, English, Japanese, or Spanish and return its results in a variety of languages. 
     * You can provide plain text, HTML, or JSON input. 
     * The service returns output in JSON format by default, but you can request the output in CSV format. 
     * 
     * @param $val string | ProfileModel
     * 
     * @return HttpResponse
     */
    public function getProfile($val) {

        if($val instanceof ProfileModel) {
            return $this->getProfileByModel($val);
        }
        else if(is_string($val)) {
            return $this->getProfileByText($val);
        }
        else {
            throw new InvalidParameterException();
        }
    }
}
