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

namespace WatsonSDK\Services\NaturalLanguageUnderstanding;

use WatsonSDK\Common\ServiceModel;

/**
 * Natural Language Understanding analyze request model
 */
class AnalyzeModel extends ServiceModel {

    const VERSION = '2017-02-27';

    const TYPE_TEXT = 'text';
    const TYPE_HTML = 'html';
    const TYPE_URL = 'url';

    const FEATURE_CONCEPTS = 'concepts';
    const FEATURE_CAEGORIES = 'categories';
    const FEATURE_EMOTION = 'emotion';
    const FEATURE_ENTITIES = 'entities';
    const FEATURE_KEYWORDS = 'keywords';
    const FEATURE_METADATA = 'metadata';
    const FEATURE_RELATIONS = 'relations';
    const FEATURE_SEMANTIC_ROLES= 'semantic_roles';
    const FEATURE_SENTIMENT = 'sentiment';

    /**
     * @data(=)
     * 
     * `text`, `html`, or `url`
     * One of these is required. The "text" attribute accepts plain text. 
     * The "html" attribute accepts formatted HTML source code. 
     * The "url" attribute accepts URLs to public webpages - "url" is not supported in Bluemix Dedicated instances.
     */
    protected $_mix;

    /**
     * @data(features)
     * 
     * Specify the features to analyze in the text, and the options to enable for each feature.
     * At least one feature is required, and you can include as many as you like. 
     * View each feature's section in the reference for options and language support. 
     * Adding features and options may incur additional billable API events. Availabe features:
     * 
     * - concepts
     * - categories
     * - emotion
     * - entities
     * - keywords
     * - metadata
     * - relations
     * - semantic_roles
     * - sentiment
     */
    protected $_features;

    /**
     * @data(language)
     * 
     * ISO 639-1 code indicating the language to use for the analysis.
     * This code overrides the automatic language detection performed by the service.
     * Valid codes are ar(Arabic), en(English), fr(French), de(German), it(Italian), pt(Portuguese), ru(Russian), es(Spanish), and sv(Swedish).
     * 
     * @see https://www.ibm.com/watson/developercloud/doc/natural-language-understanding/index.html#supported-languages
     */
    protected $_language;

    /**
     * @data(clean)
     * 
     * Set to false to disable text cleaning. By default, the service cleans input to remove generally unwanted content, such as advertisements.
     */
    protected $_clean;

    /**
     * @data(fallback_to_raw)
     * 
     * Whether to use raw HTML content if text cleaning fails. This defaults to false.
     */
    protected $_fallback_to_raw;

    /**
     * @data(return_analyzed_text)
     * 
     * Whether to use raw HTML content if text cleaning fails. This defaults to false.
     */
    protected $_return_analyzed_text;

    /**
     * Constructor
     * 
     * @param $content string
     * @param $features array
     * @param $type string
     * @param $language string | NULL
     * @param $clean boolean | NULL
     * @param $fallback_to_raw boolean | NULL
     * @param $return_analyzed_text boolean | NULL
     * @param $version string
     */
    function __construct($content, $features, $type = self::TYPE_TEXT, $language = NULL, $clean = NULL, $fallback_to_raw = NULL, $return_analyzed_text = NULL, $version = self::VERSION) {

        $this->_mix = [ $type => $content ];
        $this->_features = $features;
        $this->_language = $language;
        $this->_clean = $clean;
        $this->_fallback_to_raw = $fallback_to_raw;
        $this->_return_analyzed_text = $return_analyzed_text;
        $this->_version = $version;
    }

    /**
     * Get type of the content to be analyzed
     * @return array
     */
    public function getContents() {
        return $this->_mix;
    }

    /**
     * Set type of the content to be analyzed
     * 
     * @param $key string
     * @param $val string
     */
    public function setContents($key, $val) {
        $this->_mix = [ $key => $val ];
    }

    /**
     * Get features
     * @return array
     */
    public function getFeatures() {
        return $this->_features;
    }

    /**
     * Set features
     * @param $val array
     */
    public function setFeatures($val) {
        $this->_features = $val;
    }

    /**
     * Get ISO 639-1 code indicating the language to use for the analysis
     * @return string
     */
    public function getLanguage() {
        return $this->_language;
    }

    /**
     * Set ISO 639-1 code to indicate the language to use for the analysis
     * @param $val string
     */
    public function setLanguage($val) {
        $this->_language = $val;
    }

    /**
     * Check if the text clearning is enabled
     * @return boolean
     */
    public function getClean() {
        return $this->_clean;
    }

    /**
     * Set text cleaning
     * @param $val boolean
     */
    public function setClean($val) {
        $this->_clean = $val;
    }

    /**
     * Check whether to use raw HTML content if text cleaning fails
     * @return boolean
     */
    public function getFallbackToRaw() {
        return $this->_fallback_to_raw;
    }

    /**
     * Set the flag using raw HTML content if text cleaning fails
     * @param $val boolean
     */
    public function setFallbackToRaw($val) {
        $this->_fallback_to_raw = $val;
    }

    /**
     * Check if it is hiding the analyzed text in the response
     * @return boolean
     */
    public function getReturnAnalyzedText() {
        return $this->_return_analyzed_text;
    }

    /**
     * Set flag for hiding the analyzed text in the response
     * @param $val boolean
     */
    public function setReturnAnalyzedText($val) {
        $this->_return_analyzed_text = $val;
    }
}