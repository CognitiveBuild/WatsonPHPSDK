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

    const VERSION = '2016-10-20';
    const BASE_URL = 'https://gateway.watsonplatform.net/personality-insights/api/v3';

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
     * @param $val ContentItems
     * @param $raw_scores boolean | NULL
     * @param $consumption_preferences boolean | NULL
     * @param $csv_headers boolean | NULL
     * @param $accept_language string | NULL
     * @param $accept string | NULL
     * @param $content_language string | NULL
     * @param $version string
     */
    function __construct($val, $raw_scores = NULL, $consumption_preferences = NULL, $csv_headers = NULL, $accept_language = NULL, $accept = NULL, $content_language = NULL, $version = self::VERSION) {

        $this->_mix = [ self::TYPE_CONTENT_ITEMS => [$val->toArray()]];
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
     * @param $val ContentItems
     */
    public function addContent($val) {
        array_push($this->_mix[self::TYPE_CONTENT_ITEMS], $val->toArray());
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

class ContentItems{
    const CONTENT_TYPE_PLAIN='text/plain';
    const CONTENT_TYPE_HTML='text/html';

    const LANGUAGE_ARABIC='ar';
    const LANGUAGE_ENGLISH='en';
    const LANGUAGE_SPANISH='es';
    const LANGUAGE_JAPANESE='ja';

    /**
     * A maximum of 20 MB of content (combined across all ContentItem objects) to be analyzed.
     */
    protected $content;
    /**
     * A unique identifier for this content item.
     */
    protected $id;
    /**
     * A timestamp that identifies when this content was created.
     * Specify a value in milliseconds since the UNIX Epoch (January 1, 1970, at 0:00 UTC).
     * Required only for results that include temporal behavior data.
     */
    protected $created;
    /**
     * A timestamp that identifies when this content was last updated. Specify a value in milliseconds since the UNIX Epoch (January 1, 1970, at 0:00 UTC).
     * Required only for results that include temporal behavior data.
     */
    protected $updated;
    /**
     * The MIME type of the content:
     * text/plain for plain text (the default)
     * text/html for HTML content
     * The tags are stripped from HTML content before it is analyzed; plain text is processed as submitted.
     */
    protected $contenttype;
    /**
     * The language of the content as a two-letter ISO 639-1 identifier:
     * ar (Arabic)
     * en (English, the default)
     * es (Spanish)
     * ja (Japanese)
     * Regional variants are treated as their parent language; for example, en-US is interpreted as en.
     * A language specified with the Content-Language header of the request overrides the value of this parameter;
     * content items that specify a different language are ignored.
     * Omit the Content-Language header to base the language on the most prevalent specification among the content items;
     * again, content items that specify a different language are ignored.
     * You can specify any combination of languages for the input text and the response.
     */
    protected $language;
    /**
     * The unique ID of the parent content item for this item. Used to identify hierarchical relationships between posts/replies,
     * messages/replies, and so on.
     */
    protected $parentid;
    /**
     * Indicates whether this content item is a reply to another content item.
     */
    protected $reply;
    /**
     * Indicates whether this content item is a forwarded/copied version of another content item.
     */
    protected $forward;

    /**
     * ContentItems constructor.
     * @param $content string
     * @param $id string
     * @param $created integer
     * @param $updated integer
     * @param $contenttype string
     * @param $language string
     * @param $parentid string
     * @param $reply boolean
     * @param $forward boolean
     */
    public function __construct($content, $id=null, $created=null, $updated=null, $contenttype=self::CONTENT_TYPE_PLAIN, $language=self::LANGUAGE_ENGLISH, $parentid=null, $reply=null, $forward=null)
    {
        $this->content = $content;
        $this->id = $id;
        $this->created = $created;
        $this->updated = $updated;
        $this->contenttype = $contenttype;
        $this->language = $language;
        $this->parentid = $parentid;
        $this->reply = $reply;
        $this->forward = $forward;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content string
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id string
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param $created integer
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return integer
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param $updated integer
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getContenttype()
    {
        return $this->contenttype;
    }

    /**
     * @param $contenttype string
     */
    public function setContenttype($contenttype)
    {
        $this->contenttype = $contenttype;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param $language string
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * @param $parentid string
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
    }

    /**
     * @return boolean
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * @param $reply boolean
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    /**
     * @return boolean
     */
    public function getForward()
    {
        return $this->forward;
    }

    /**
     * @param $forward boolean
     */
    public function setForward($forward)
    {
        $this->forward = $forward;
    }



    function toArray() {
        if (is_object($this)) {
            foreach ($this as $key => $value) {
                if(!is_null($value))
                    $array[$key] = $value;
            }
        }
        else {
            $array = $this;
        }
        return $array;
    }


}