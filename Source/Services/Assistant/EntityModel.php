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

namespace WatsonSDK\Services\Assistant;

use WatsonSDK\Common\ServiceModel;

/**
 * Assistant Entity model
 */
class EntityModel extends ServiceModel {

    /**
     * @name(entity)
     * 
     * An entity detected in the input.
     * 
     * @var string
     */
    protected $_entity;

    /**
     * @name(location)
     * 
     * An array of zero-based character offsets that indicate where the detected entity values begin and end in the input text.
     * 
     * @var array
     */
    protected $_location;

    /**
     * @name(value)
     * 
     * The term in the input that was recognized as an entity value.
     * 
     * @var string
     */
    protected $_value;

    /**
     * @name(confidence)
     * 
     * A decimal percentage that represents Watson's confidence in the entity.
     *
     * @var float
     */
    protected $_confidence;

    /**
     * @name(metadata)
     * 
     * Any metadata for the entity.
     *
     * @var array
     */
    protected $_metadata;

    /**
     * @array(groups)
     * 
     * The recognized capture groups for the entity, as defined by the entity pattern.
     *
     * @var CaptureGroup[]
     */
    protected $_groups;

    /**
     * Constructor.
     *
     * @param string $entity
     * @param array $location
     * @param string $value
     * @param float $confidence
     * @param array $metadata
     * @param array $groups
     */
    function __construct($entity = NULL, array $location = NULL, $value = NULL, $confidence = NULL, array $metadata = NULL, array $groups = NULL) {

        $this->setEntity($entity);
        $this->setLocation($location);
        $this->setValue($value);
        $this->setConfidence($confidence);
        $this->setMetadata($metadata);
        $this->setGroups($groups);
    }

    /**
     * Get entity detected in the input.
     * 
     * @return string
     */
    public function getEntity() {
        return $this->_entity;
    }

    /**
     * Set entity detected in the input.
     * 
     * @param $val string
     */
    public function setEntity($val) {
        $this->_entity = $val;
    }

    /**
     * Set locations
     * 
     * @return array
     */
    public function getLocation() {
        return $this->_location;
    }

    /**
     * Set locations
     * 
     * @param $val array
     */
    public function setLocation($val) {
        $this->_location = $val;
    }

    /**
     * Get the term in the input that was recognized as an entity value.
     * 
     * @return string
     */
    public function getValue() {
        return $this->_value;
    }

    /**
     * Set the term in the input that was recognized as an entity value.
     * 
     * @param $val string
     */
    public function setValue($val) {
        $this->_value = $val;
    }

    /**
     * Get the decimal percentage that represents Watson's confidence in the entity.
     * 
     * @return float
     */
    public function getConfidence() {
        return $this->_confidence;
    }

    /**
     * Set the decimal percentage that represents Watson's confidence in the entity.
     * 
     * @param float $val
     */
    public function setConfidence($val) {
        $this->_confidence = $val;
    }

    /**
     * Get metadata for the entity.
     * 
     * @return array
     */
    public function getMetadata() {
        return $this->_metadata;
    }

    /**
     * Set metadata for the entity.
     * 
     * @param array $val
     */
    public function setMetadata($val) {
        $this->_metadata = $val;
    }

    /**
     * Get the recognized capture groups for the entity, as defined by the entity pattern.
     * 
     * @return array
     */
    public function getGroups() {
        return $this->_groups;
    }

    /**
     * Set the recognized capture groups for the entity, as defined by the entity pattern.
     * 
     * @param array $val
     */
    public function setGroups($val) {
        $this->_groups = $val;
    }
}