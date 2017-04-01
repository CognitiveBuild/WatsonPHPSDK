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
 * Conversation LogMessageResponse model
 */
class LogMessageResponseModel extends ServiceModel {

    /**
     * @name(level)
     * 
     * The severity of the message (info, error, or warn).
     * 
     * @var string
     */
    protected $_level;

    /**
     * @name(msg)
     * 
     * The text of the log message.
     * 
     * @var string
     */
    protected $_msg;

    /**
     * Constructor.
     * 
     * @param $level string
     * @param $msg string
     */
    function __construct($level, $msg) {

        $this->setLevel($level);
        $this->setMsg($text);
    }

    /**
     * Get the severity of the message (info, error, or warn).
     * 
     * @return string
     */
    public function getLevel() {
        return $this->_level;
    }

    /**
     * Set the severity of the message (info, error, or warn).
     * 
     * @param $val string
     */
    public function setLevel($val) {
        $this->_level = $val;
    }

    /**
     * Get text of the log message.
     * 
     * @return string
     */
    public function getMsg() {
        return $this->_msg;
    }

    /**
     * Set text of the log message.
     * 
     * @param $val string
     */
    public function setMsg($val) {
        $this->_msg = $val;
    }
}