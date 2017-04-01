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
 * Conversation InputData model
 */
class InputDataModel extends ServiceModel {

    /**
     * @name(text)
     * 
     * The text of the user input.
     * 
     * @var string
     */
    protected $_text;

    /**
     * Constructor.
     * 
     * @param $text string
     */
    function __construct($text) {

        $this->setText($text);
    }

    /**
     * Get the text of the user input.
     * 
     * @return string
     */
    public function getText() {
        return $this->_text;
    }

    /**
     * Set the text of the user input.
     * 
     * @param $val string
     */
    public function setText($val) {
        $this->_text = $val;
    }
}