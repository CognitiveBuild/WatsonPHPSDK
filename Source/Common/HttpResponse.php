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

namespace WatsonSDK\Common;

class HttpResponse {

    /**
     * Response body, normally string
     */
    private $_content;

    /**
     * Standard HTTP status code
     */
    private $_status_code;

    /**
     * Response size
     */
    private $_size;

    /**
     * Constructor
     * 
     * @param $code int
     * @param $content string
     * @param $size int
     */
    function __construct($code = 200, $content = '', $size = 0) {

        $this->_status_code = $code;
        $this->_size = $size;
        $this->_content = $content;
    }

    /**
     * Return response body for common use
     * 
     * @return string
     */
    public function __toString() {
        return $this->_content;
    }

    /**
     * Return response body
     * 
     * @return string
     */
    public function getContent($json_decode = FALSE, $json_assoc = TRUE) {
        if($json_decode) {
            return json_decode($this->_content, $json_assoc);
        }
        return $this->_content;
    }

    /**
     * Return response size
     * 
     * @return int
     */
    public function getSize() {
        return $this->_size;
    }

    /**
     * Return HTTP status code
     * 
     * @return int
     */
    public function getStatusCode() {
        return $this->_status_code;
    }
}