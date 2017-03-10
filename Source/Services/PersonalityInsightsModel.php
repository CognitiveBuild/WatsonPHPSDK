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
 * Personality Insights entity class
 */
class PersonalityInsightsModel extends ServiceModel {

    const BASE_URL = 'https://gateway.watsonplatform.net/personality-insights/api/v3';

    /**
     * @data(contentItems)
     * 
     * An array of ContentItem objects that provides the input text for the request.
     */
    protected $contentItems;

    /**
     * @query(raw_scores)
     * 
     * Indicates whether a raw score in addition to a normalized percentile is to be returned for each characteristic; raw scores are not compared with a sample population. By default (false),
     * only normalized percentiles are returned.
     */
    protected $_raw_scores;

    /**
     * @query(version)
     * 
     * When we make breaking changes to the API, we release a new, dated version.
     * The value for the version parameter is the date for the version of the API that you want to call.
     * The current version is 2016-05-19, and the documentation reflects the current version.
     */
    private $_version;

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
     * When Content-Type is application/json, Content-Language overrides a language specified with the language parameter of a ContentItem object; content items that specify a different language are ignored. Omit this header to base the language on the specification of the content items.
     * You can specify any combination of languages for Content-Language and Accept-Language.
     */
    protected $_Content_Language;

    /**
     * @header(Accept)
     *
     * The desired content type of the response:
     * application/json for JSON output (the default)
     * text/csv for CSV output
     * CSV output includes a fixed number of columns and optional headers.
     */
    protected $_Accept;

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
    protected $_Accept_Language;


    /**
     * Constructor
     * 
     * @param $contentItems string
     * @param $raw_scores boolean | NULL
     * @param $consumption_preferences boolean | NULL
     * @param $csv_headers boolean | NULL
     * @param $csv_headers boolean | NULL
     * @param $Accept_Language string | NULL
     * @param $Accept string | NULL
     * @param $Content_Language string | NULL
     * @param $version string
     */
    function __construct($contentItems = '', $raw_scores = NULL, $consumption_preferences = NULL,$csv_headers=null,$Accept_Language=null,$Accept=null,$Content_Language=null, $version = '2016-10-20') {

        $this->contentItems = $contentItems;
        $this->_raw_scores=$raw_scores;
        $this->_consumption_preferences=$consumption_preferences;
        $this->_csv_headers=$csv_headers;
        $this->_Accept=$Accept;
        $this->_Accept_Language=$Accept_Language;
        $this->_Content_Language=$Content_Language;
        $this->_version = $version;
    }

    /**
     * @return mixed
     */
    public function getContentItems()
    {
        return $this->contentItems;
    }

    /**
     * @param mixed $contentItems
     */
    public function setContentItems($contentItems)
    {
        $this->contentItems = $contentItems;
    }

    /**
     * @return mixed
     */
    public function getRawScores()
    {
        return $this->_raw_scores;
    }

    /**
     * @param mixed $raw_scores
     */
    public function setRawScores($raw_scores)
    {
        $this->_raw_scores = $raw_scores;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->_version = $version;
    }

    /**
     * @return mixed
     */
    public function getConsumptionPreferences()
    {
        return $this->_consumption_preferences;
    }

    /**
     * @param mixed $consumption_preferences
     */
    public function setConsumptionPreferences($consumption_preferences)
    {
        $this->_consumption_preferences = $consumption_preferences;
    }

    /**
     * @return mixed
     */
    public function getCsvHeaders()
    {
        return $this->_csv_headers;
    }

    /**
     * @param mixed $csv_headers
     */
    public function setCsvHeaders($csv_headers)
    {
        $this->_csv_headers = $csv_headers;
    }

    /**
     * @return mixed
     */
    public function getContentLanguage()
    {
        return $this->_Content_Language;
    }

    /**
     * @param mixed $Content_Language
     */
    public function setContentLanguage($Content_Language)
    {
        $this->_Content_Language = $Content_Language;
    }

    /**
     * @return mixed
     */
    public function getAccept()
    {
        return $this->_Accept;
    }

    /**
     * @param mixed $Accept
     */
    public function setAccept($Accept)
    {
        $this->_Accept = $Accept;
    }

    /**
     * @return mixed
     */
    public function getAcceptLanguage()
    {
        return $this->_Accept_Language;
    }

    /**
     * @param mixed $Accept_Language
     */
    public function setAcceptLanguage($Accept_Language)
    {
        $this->_Accept_Language = $Accept_Language;
    }

}