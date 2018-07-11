<?php
/**
 * Copyright 2018 IBM Corp. All Rights Reserved.
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

namespace WatsonSDK\Services\Assistant;

use WatsonSDK\Common\ServiceModel;

/**
 * Assistant CreateValue model
 */
class CreateValueModel extends ServiceModel {

    const VALUE_TYPE_SYNONYMS = 'synonyms';
    const VALUE_TYPE_PATTERNS = 'patterns';

    /**
     * @name(value)
     * 
     * The text of the entity value. This string must conform to the following restrictions:
     * - It cannot contain carriage return, newline, or tab characters.
     * - It cannot consist of only whitespace characters.
     * - It must be no longer than 64 characters.
     * 
     * @var string
     */
    protected $_value;

    /**
     * @array(metadata)
     * 
     * Any metadata related to the entity value.
     * 
     * @var array
     */
    protected $_metadata;

    /**
     * @array(synonyms)
     * 
     * An array containing any synonyms for the entity value. 
     * You can provide either synonyms or patterns (as indicated by type), but not both. 
     * A synonym must conform to the following restrictions:
     * 
     * - It cannot contain carriage return, newline, or tab characters.
     * - It cannot consist of only whitespace characters.
     * - It must be no longer than 64 characters.
     * 
     * @var array
     */
    protected $_synonyms;

    /**
     * @array(patterns)
     * 
     * An array of patterns for the entity value. 
     * You can provide either synonyms or patterns (as indicated by type), but not both. 
     * A pattern is a regular expression no longer than 128 characters. 
     * For more information about how to specify a pattern, see the <a href="https://console.bluemix.net/docs/services/conversation/entities.html#creating-entities">documentation</a>.
     *
     * @var array
     */
    protected $_patterns;

    /**
     * @name(value_type)
     * 
     * Specifies the type of value.
     * Allowable values:
     * - synonyms
     * - patterns
     * default: synonyms
     *
     * @var string
     */
    protected $_value_type;

    /**
     * Constructor.
     */
    function __construct($value, array $metadata = NULL, array $synonyms = NULL, array $patterns, $value_type = self::VALUE_TYPE_SYNONYMS) {

        $this->setValue($value);
        $this->setMetadata($metadata);
        $this->setSynonyms($synonyms);
        $this->setPatterns($patterns);
        $this->setValueType($value_type);
    }

    /**
     * Get the text of the entity value.
     * 
     * @return string
     */
    public function getValue() {
        return $this->_value;
    }

    /**
     * Set the text of the entity value.
     * 
     * @param $val string
     */
    public function setValue($val) {
        $this->_value = $val;
    }

    /**
     * Get metadata related to the entity value.
     *
     * @return array
     */
    public function getMetadata() {
        return $this->_metadata;
    }

    /**
     * Set metadata related to the entity value.
     *
     * @param array $val
     */
    public function setMetadata($val) {
        $this->_metadata = $val;
    }

    /**
     * Get array containing any synonyms for the entity value.
     *
     * @param array $val
     */
    public function getSynonyms($val) {
        return $this->_synonyms;
    }

    /**
     * Set array containing any synonyms for the entity value.
     *
     * @param array $val
     * @return array
     */
    public function setSynonyms($val) {
        $this->_synonyms = $val;
    }

    /**
     * Get array of patterns for the entity value.
     *
     * @param array $val
     */
    public function getPatterns($val) {
        return $this->_patterns;
    }

    /**
     * Set array of patterns for the entity value.
     *
     * @param array $val
     * @return array
     */
    public function setPatterns($val) {
        $this->_patterns = $val;
    }

    /**
     * Get type of value.
     *
     * @param string $val
     */
    public function getValueType($val) {
        return $this->_value_type;
    }

    /**
     * Set type of value.
     *
     * @param string $val
     * @return string
     */
    public function setValueType($val) {
        $this->_value_type = $val;
    }
}