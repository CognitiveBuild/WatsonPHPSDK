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

namespace WatsonSDK\Services\Conversation;

use WatsonSDK\Common\ServiceModel;

/**
 * Conversation Entity model
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
     * Constructor.
     * 
     * @param $entity string | NULL
     * @param $location array
     * @param $value string | NULL
     */
    function __construct($entity = NULL, $location = NULL, $value = NULL) {

        $this->setEntity($entity);
        $this->setLocation($location);
        $this->setValue($value);
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
}