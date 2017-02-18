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

use WatsonSDK\Common\ServiceModel;

/**
 * Tone Analyzer entity class
 * 
 * @todo: Properties to be sent to the services need to be protected
 */
class ToneAnalyzerModel extends ServiceModel {

    const BASE_URL = 'https://gateway.watsonplatform.net/tone-analyzer/api/v3';

    // Text that contains the content to be analyzed. The Tone Analyzer Service supports up to 128KB of text, or about 1000 sentences. 
    // Sentences with less than three words cannot be analyzed.
    protected $text;
    // Filter the results by a specific tone. Valid values for tones are emotion, language, and social.
    protected $tones;
    // When we make breaking changes to the API, we release a new, dated version. 
    // The value for the version parameter is the date for the version of the API that you want to call. 
    // The current version is 2016-05-19, and the documentation reflects the current version. 
    private $_version;
    // Filter your response to remove the sentence level analysis. Valid values for sentences are true and false. 
    // This parameter defaults to true when it's not set, which means that a sentence level analysis is automatically provided. 
    // Change sentences=false to filter out the sentence level analysis. 
    protected $sentences;

    function __construct($text = '', $tones = NULL, $sentences = NULL, $version = '2016-05-19') {

        $this->text = $text;
        $this->tones = $tones;
        $this->sentences = $sentences;
        $this->_version = $version;
    }

    /**
     * Get text
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Set text
     * @param $val
     */
    public function setText($val) {
        $this->text = $val;
    }

    /**
     * Get tones
     * @return string
     */
    public function getTones() {
        return $this->tones;
    }

    /**
     * Set tones
     * @param $val
     */
    public function setTones($val) {
        $this->tones = $val;
    }

    /**
     * Get sentences
     * @return string
     */
    public function getSentences() {
        return $this->sentences;
    }

    /**
     * Set sentences
     * @param $val
     */
    public function setSentences($val) {
        $this->sentences = $val;
    }

    /**
     * Get version
     * @return string
     */
    public function getVersion() {
        return $this->_version;
    }

    /**
     * Set version
     * @param $val
     */
    public function setVersion($val) {
        $this->_version = $val;
    }

}