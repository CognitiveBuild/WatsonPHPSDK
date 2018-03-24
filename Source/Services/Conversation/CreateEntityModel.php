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
 * Conversation CreateEntity model
 */
class CreateEntityModel extends ServiceModel {

    /**
     * @name(entity)
     * 
     * The name of the entity (for example, beverage).
     * 
     * @var string
     */
    protected $_entity;

    /**
     * @name(description)
     * 
     * The description of the entity.
     * 
     * @var string
     */
    protected $_description;

    /**
     * @name(metadata)
     * 
     * Any metadata related to the entity.
     * 
     * @var array
     */
    protected $_metadata;

    /**
     * @name(values)
     * 
     * An array of entity values.
     * 
     * @var array
     */
    protected $_values;

    /**
     * @name(fuzzy_match)
     * 
     * Whether to use fuzzy matching for the entity.
     * 
     * @var boolean
     */
    protected $_fuzzy_match;

    /**
     * Get the name of the entity (for example, beverage).
     * 
     * @return string
     */
    public function getEntity() {
        return $this->_entity;
    }

    /**
     * Set the name of the entity (for example, beverage).
     * 
     * @param $val string
     */
    public function setEntity($val) {
        $this->_entity = $val;
    }

    /**
     * Get the description of the entity.
     * 
     * @return string
     */
    public function getDescription() {
        return $this->_description;
    }

    /**
     * Set the description of the entity.
     * 
     * @param $val string
     */
    public function setDescription($val) {
        $this->_description = $val;
    }

    /**
     * Get the metadata related to the entity.
     * 
     * @return array
     */
    public function getMetadata() {
        return $this->_metadata;
    }

    /**
     * Set the metadata related to the entity.
     * 
     * @param $val array
     */
    public function setMetadata($val) {
        $this->_metadata = $val;
    }


    /**
     * Get array of entity values.
     *
     * @return array
     */
    public function getValues() {
        return $this->_values;
    }

    /**
     * Set array of entity values.
     *
     * @param $val array
     */
    public function setValues(array $val) {
        $this->_values = $val;
    }

    /**
     * Get the value indicates whether to use fuzzy matching for the entity. 
     *
     * @return boolean
     */
    public function getFuzzyMatch() {
        return $this->_fuzzy_match;
    }

    /**
     * Set the value indicates whether to use fuzzy matching for the entity. 
     *
     * @param boolean $val
     */
    public function setFuzzyMatch($val) {
        $this->_fuzzy_match = $val;
    }

}