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
 * CaptureGroup model
 */
class CaptureGroupModel extends ServiceModel {

    /**
     * @name(group)
     * 
     * A recognized capture group for the entity.
     * 
     * @var string
     */
    protected $_group;

    /**
     * @array(location)
     * 
     * Zero-based character offsets that indicate where the entity value begins and ends in the input text.
     * 
     * @var integer[]
     */
    protected $_location;

    /**
     * Constructor.
     * 
     * @param string $group
     * @param integer[] $location
     */
    function __construct($group, array $location = NULL) {

        $this->setGroup($group);
        $this->setLocation($location);
    }

    /**
     * Get recognized capture group for the entity.
     * 
     * @return string
     */
    public function getGroup() {
        return $this->_group;
    }

    /**
     * Set recognized capture group for the entity.
     * 
     * @param string $val
     */
    public function setGroup($val) {
        $this->_group = $val;
    }

    /**
     * Get zero-based character offsets that indicate where the entity value begins and ends in the input text.
     * 
     * @return integer[]
     */
    public function getLocation() {
        return $this->_location;
    }

    /**
     * Set zero-based character offsets that indicate where the entity value begins and ends in the input text.
     * 
     * @param integer[] $val
     */
    public function setLocation($val) {
        $this->_location = $val;
    }

}