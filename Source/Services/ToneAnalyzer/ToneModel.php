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

namespace WatsonSDK\Services\ToneAnalyzer;

use WatsonSDK\Common\ServiceModel;

/**
 * Tone Analyzer tone request model
 */
class ToneModel extends ServiceModel {

    const VERSION = '2016-05-19';

    /**
     * @data(text)
     *
     * Text that contains the content to be analyzed. The Tone Analyzer Service supports up to 128KB of text,
     * or about 1000 sentences.Sentences with less than three words cannot be analyzed.
     */
    protected $_text;

    /**
     * @query(tones)
     *
     * Filter the results by a specific tone. Valid values for tones are emotion, language, and social.
     */
    protected $_tones;

    /**
     * @query(sentences)
     *
     * Filter your response to remove the sentence level analysis. Valid values for sentences are true and false.
     * This parameter defaults to true when it's not set, which means that a sentence level analysis is automatically provided.
     * Change sentences=false to filter out the sentence level analysis.
     */
    protected $_sentences;

    /**
     * Constructor
     *
     * @param $text string
     * @param $tones string | NULL
     * @param $sentences string | NULL
     * @param $version string
     */
    function __construct($text = '', $tones = NULL, $sentences = NULL, $version = self::VERSION) {

        $this->_text = $text;
        $this->_tones = $tones;
        $this->_sentences = $sentences;
        $this->_version = $version;
    }

    /**
     * Get text
     * @return string
     */
    public function getText() {
        return $this->_text;
    }

    /**
     * Set text
     * @param $val string
     */
    public function setText($val) {
        $this->_text = $val;
    }

    /**
     * Get tones
     * @return string
     */
    public function getTones() {
        return $this->_tones;
    }

    /**
     * Set tones
     * @param $val string
     */
    public function setTones($val) {
        $this->_tones = $val;
    }

    /**
     * Get sentences
     * @return string
     */
    public function getSentences() {
        return $this->_sentences;
    }

    /**
     * Set sentences
     * @param $val string
     */
    public function setSentences($val) {
        $this->_sentences = $val;
    }

}