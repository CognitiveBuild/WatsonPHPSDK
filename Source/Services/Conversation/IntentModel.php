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
 * Conversation Intent model
 */
class IntentModel extends ServiceModel {

    /**
     * @name(intent)
     * 
     * The name of the recognized intent.
     * 
     * @var string
     */
    protected $_intent;

    /**
     * A decimal percentage that represents the confidence that Watson has in this intent. Higher values represent higher confidences. 
     * 
     * @var float
     */
    protected $_confidence;

    /**
     * Constructor.
     * 
     * @param $intent string | NULL
     * @param $confidence float | NULL
     */
    function __construct($intent = NULL, $confidence = NULL) {

        $this->setIntent($intent);
        $this->setConfidence($confidence);
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
     * @param $val string
     */
    public function setIntent($val) {
        $this->_intent = $val;
    }

    /**
     * Get percentage that represents the confidence that Watson has in this intent.
     * 
     * @return float
     */
    public function getConfidence() {
        return $this->_confidence;
    }

    /**
     * Set percentage that represents the confidence that Watson has in this intent.
     * 
     * @param $val float
     */
    public function setConfidence($val) {
        $this->_confidence = $val;
    }
}