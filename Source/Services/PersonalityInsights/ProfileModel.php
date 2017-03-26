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

namespace WatsonSDK\Services\PersonalityInsights;

use WatsonSDK\Common\ServiceModel;

/**
 * Personality Insights profile request model
 */
class ProfileModel extends ServiceModel {

    const VERSION = '2016-10-20';

    const TYPE_CONTENT_ITEMS = 'contentItems';

    const CONTENT_TYPE_TEXT = 'text/plain';
    const CONTENT_TYPE_HTML = 'text/html';

    /**
     * @data(=)
     * 
     * An array of ContentItem objects that provides the input text for the request.
     */
    protected $_mix;

    /**
     * @query(raw_scores)
     * 
     * Indicates whether a raw score in addition to a normalized percentile is to be returned for each characteristic; raw scores are not compared with a sample population. By default (false),
     * only normalized percentiles are returned.
     */
    protected $_raw_scores;

    /**
     * @query(consumption_preferences)
     * 
     * Indicates whether consumption preferences are to be returned with the results. By default (false), they are not.
     */
    protected $_consumption_preferences;

    /**
     * @query(csv_headers)
     *
     * Indicates whether column labels are to be returned with a CSV response. By default (false), they are not.
     * Applies only when the Accept header is set to text/csv.
     */
    protected $_csv_headers;

    /**
     * @header(Content-Language)
     *
     * The language of the input text for the request:
     * ar (Arabic)
     * en (English, the default)
     * es (Spanish)
     * ja (Japanese)
     * Regional variants are treated as their parent language; for example, en-US is interpreted as en. The effect of the Content-Language header depends on the Content-Type header:
     * When Content-Type is text/plain or text/html, Content-Language is the only way to specify the language.
     * When Content-Type is application/json, Content-Language overrides a language specified with the language parameter of a ContentItem object; content items that specify a different language are ignored. 
     * Omit this header to base the language on the specification of the content items.
     * You can specify any combination of languages for Content-Language and Accept-Language.
     */
    protected $_content_language;

    /**
     * @header(Accept)
     *
     * The desired content type of the response:
     * application/json for JSON output (the default)
     * text/csv for CSV output
     * CSV output includes a fixed number of columns and optional headers.
     */
    protected $_accept;

    /**
     * @header(Accept-Language)
     *
     * The desired language of the response:
     * ar (Arabic)
     * de (German)
     * en (English, the default)
     * es (Spanish)
     * fr (French)
     * it (Italian)
     * ja (Japanese)
     * ko (Korean)
     * pt-br (Brazilian Portuguese)
     * zh-cn (Simplified Chinese)
     * zh-tw (Traditional Chinese)
     * For two-character arguments, regional variants are treated as their parent language;
     * for example, en-US is interpreted as en. You can specify any combination of languages for the request and the response.
     */
    protected $_accept_language;

    /**
     * Constructor
     *
     * @param $val string | ContentItemModel
     * @param $raw_scores boolean | NULL
     * @param $consumption_preferences boolean | NULL
     * @param $csv_headers boolean | NULL
     * @param $accept_language string | NULL
     * @param $accept string | NULL
     * @param $content_language string | NULL
     * @param $version string
     */
    function __construct($val, $raw_scores = NULL, $consumption_preferences = NULL, $csv_headers = NULL, $accept_language = NULL, $accept = NULL, $content_language = NULL, $version = self::VERSION) {

        if($val instanceof ContentItemModel) {
            $this->_mix = [ self::TYPE_CONTENT_ITEMS => [ $val->getData('@name') ] ];
        }
        else if(is_string($val)) {
            $model = new ContentItemModel($val);
            $this->_mix = [ self::TYPE_CONTENT_ITEMS => [ $model->getData('@name') ] ];
        }

        $this->_raw_scores = $raw_scores;
        $this->_consumption_preferences = $consumption_preferences;
        $this->_csv_headers = $csv_headers;
        $this->_accept_language = $accept_language;
        $this->_accept = $accept;
        $this->_content_language = $content_language;
        $this->_version = $version;
    }

    /**
     * Get the array of ContentItem objects that provides the input text for the request
     * @return array
     */
    public function getContents() {
        return $this->_mix;
    }

    /**
     * Set the array of ContentItem objects that provides the input text for the request
     * @param $val array
     */
    public function setContents($val) {
        $this->_mix = [ self::TYPE_CONTENT_ITEMS => $val ];
    }

    /**
     * Set the array of ContentItem objects that provides the input text for the request
     * @param $val ContentItemModel
     */
    public function addContent($val) {
        array_push($this->_mix[self::TYPE_CONTENT_ITEMS], $val->getData('@name'));
    }

    /**
     * Get indicator of raw scores
     * @return boolean
     */
    public function getRawScores() {
        return $this->_raw_scores;
    }

    /**
     * Set the indicator to show raw scores
     * @param $val boolean
     */
    public function setRawScores($val) {
        $this->_raw_scores = $val;
    }

    /**
     * Get consumption preferences
     * @return boolean
     */
    public function getConsumptionPreferences() {
        return $this->_consumption_preferences;
    }

    /**
     * Set consumption preferences
     * @param $val boolean
     */
    public function setConsumptionPreferences($val) {
        $this->_consumption_preferences = $val;
    }

    /**
     * Get the response format if it is set to CSV format, or not
     * @return boolean
     */
    public function getCsvHeaders() {
        return $this->_csv_headers;
    }

    /**
     * Set response as the CSV format.
     * If set to TRUE, it only applies when the Accept header is set to text/csv
     * @param $val boolean
     */
    public function setCsvHeaders($val) {
        $this->_csv_headers = $val;
    }

    /**
     * Set language of the input text for the request
     * @return string
     */
    public function getContentLanguage() {
        return $this->_content_language;
    }

    /**
     * Set language of the input text for the request
     * @param $val string
     */
    public function setContentLanguage($val) {
        $this->_content_language = $val;
    }

    /**
     * Get desired content type of the response
     * @return string
     */
    public function getAccept() {
        return $this->_accept;
    }

    /**
     * Set desired content type of the response
     * @param $val string
     */
    public function setAccept($val) {
        $this->_accept = $val;
    }

    /**
     * Get the desired language of the response
     * @return $val string
     */
    public function getAcceptLanguage() {
        return $this->_accept_language;
    }

    /**
     * Set the desired language of the response
     * @param $val string
     */
    public function setAcceptLanguage($val) {
        $this->_accept_language = $val;
    }

}
