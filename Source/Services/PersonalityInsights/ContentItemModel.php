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
 * Personality Insights ContentItem entity class
 */
class ContentItemModel extends ServiceModel {

    const CONTENT_TYPE_PLAIN = 'text/plain';
    const CONTENT_TYPE_HTML = 'text/html';

    const LANGUAGE_AR = 'ar';
    const LANGUAGE_EN = 'en';
    const LANGUAGE_SP = 'es';
    const LANGUAGE_JA = 'ja';

    /**
     * @name(content)
     * 
     * A maximum of 20 MB of content (combined across all ContentItem objects) to be analyzed.
     */
    protected $_content;

    /**
     * @name(id)
     * 
     * A unique identifier for this content item.
     */
    protected $_id;

    /**
     * @name(created)
     * A timestamp that identifies when this content was created.
     * Specify a value in milliseconds since the UNIX Epoch (January 1, 1970, at 0:00 UTC).
     * Required only for results that include temporal behavior data.
     */
    protected $_created;

    /**
     * @name(updated)
     * 
     * A timestamp that identifies when this content was last updated. Specify a value in milliseconds since the UNIX Epoch (January 1, 1970, at 0:00 UTC).
     * Required only for results that include temporal behavior data.
     */
    protected $_updated;

    /**
     * @name(contenttype)
     * 
     * The MIME type of the content:
     * text/plain for plain text (the default)
     * text/html for HTML content
     * The tags are stripped from HTML content before it is analyzed; plain text is processed as submitted.
     */
    protected $_content_type;

    /**
     * @name(language)
     * 
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
    protected $_language;

    /**
     * @name(parentid)
     * 
     * The unique ID of the parent content item for this item. Used to identify hierarchical relationships between posts/replies,
     * messages/replies, and so on.
     */
    protected $_parent_id;

    /**
     * @name(reply)
     * 
     * Indicates whether this content item is a reply to another content item.
     */
    protected $_reply;

    /**
     * @name(forward)
     * 
     * Indicates whether this content item is a forwarded/copied version of another content item.
     */
    protected $_forward;

    /**
     * ContentItemModel constructor
     * 
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
    public function __construct($content, $id = NULL, $created = NULL, $updated = NULL, $content_type = NULL, $language = NULL, $parent_id = NULL, $reply = NULL, $forward = NULL) {

        $this->_content = $content;
        $this->_id = $id;
        $this->_created = $created;
        $this->_updated = $updated;
        $this->_content_type = $content_type;
        $this->_language = $language;
        $this->_parent_id = $parent_id;
        $this->_reply = $reply;
        $this->_forward = $forward;
    }

    /**
     * Get content (combined across all ContentItem objects) to be analyzed.
     * @return string
     */
    public function getContent() {
        return $this->_content;
    }

    /**
     * Set content
     * @param $content string
     */
    public function setContent($content) {
        $this->_content = $content;
    }

    /**
     * Get the unique identifier for this content item.
     * @return string
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Set the unique identifier for this content item.
     * @param $id string
     */
    public function setId($id) {
        $this->_id = $id;
    }

    /**
     * Get timestamp that identifies when this content was created.
     * @return integer
     */
    public function getCreated() {
        return $this->_created;
    }

    /**
     * Set timestamp that identifies when this content was created.
     * @param $created integer
     */
    public function setCreated($created) {
        $this->_created = $created;
    }

    /**
     * Get timestamp that identifies when this content was last updated.
     * @return integer
     */
    public function getUpdated() {
        return $this->_updated;
    }

    /**
     * Set timestamp that identifies when this content was last updated.
     * @param $updated integer
     */
    public function setUpdated($updated) {
        $this->_updated = $updated;
    }

    /**
     * @return string
     */
    public function getContentType() {
        return $this->_content_type;
    }

    /**
     * Get the MIME type of the content.
     * @param $content_type string
     */
    public function setContentType($content_type) {
        $this->_content_type = $content_type;
    }

    /**
     * Set the MIME type of the content.
     * @return string
     */
    public function getLanguage() {
        return $this->_language;
    }

    /**
     * Set the language of the content as a two-letter ISO 639-1 identifier.
     * @param $language string
     */
    public function setLanguage($language) {
        $this->_language = $language;
    }

    /**
     * Get the unique ID of the parent content item for this item.
     * @return string
     */
    public function getParentId() {
        return $this->_parent_id;
    }

    /**
     * Set the unique ID of the parent content item for this item.
     * @param $parentid string
     */
    public function setParentId($parentid) {
        $this->_parent_id = $parentid;
    }

    /**
     * Get reply relationship to another content item.
     * @return boolean
     */
    public function getReply() {
        return $this->_reply;
    }

    /**
     * Set reply relationship to another content item.
     * @param $reply boolean
     */
    public function setReply($reply) {
        $this->_reply = $reply;
    }

    /**
     * Get indicator if this content item is a forwarded/copied version of another content item.
     * @return boolean
     */
    public function getForward() {
        return $this->_forward;
    }

    /**
     * Set indicator if this content item is a forwarded/copied version of another content item.
     * @param $forward boolean
     */
    public function setForward($forward) {
        $this->_forward = $forward;
    }

}