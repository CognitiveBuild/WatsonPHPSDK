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
 * Assistant Create Intent model
 */
class CreateIntentModel extends ServiceModel {

    /**
     * @name(intent)
     * 
     * The name of the intent. This string must conform to the following restrictions:
     * - It can contain only Unicode alphanumeric, underscore, hyphen, and dot characters.
     * - It cannot begin with the reserved prefix sys-.
     * - It must be no longer than 128 characters.
     * 
     * @var string
     */
    protected $_intent;

    /**
     * @name(description)
     * 
     * The description of the intent. This string cannot contain carriage return, newline, or tab characters, and it must be no longer than 128 characters.
     * 
     * @var float
     */
    protected $_description;

    /**
     * @array(examples)
     *
     * @var CreateExample[]
     */
    protected $_examples;

    /**
     * Constructor.
     * 
     * @param $intent string
     * @param $description string
     * @param CreateExample[] $examples
     */
    function __construct($intent, $description = '', array $examples = []) {

        $this->setIntent($intent);
        $this->setDescription($description);
        $this->setExamples($examples);
    }

    /**
     * Get the name of the recognized intent.
     * 
     * @return string
     */
    public function getIntent() {
        return $this->_intent;
    }

    /**
     * Set the name of the recognized intent.
     * 
     * @param string $val
     */
    public function setIntent($val) {
        $this->_intent = $val;
    }

    /**
     * Set the description of the intent. 
     * This string cannot contain carriage return, newline, or tab characters, and it must be no longer than 128 characters.
     * 
     * @return string
     */
    public function getDescription() {
        return $this->_description;
    }

    /**
     * Get the description of the intent. 
     * 
     * @param string $val
     */
    public function setDescription($val) {
        $this->_description = $val;
    }

    /**
     * Set array of user input examples for the intent.
     * 
     * @return array
     */
    public function getExamples() {
        return $this->_examples;
    }

    /**
     * Get array of user input examples for the intent.
     * 
     * @param array $val
     */
    public function setExamples($val) {
        $this->_examples = $val;
    }
}