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

    private $_content;
    private $_status_code;
    private $_size;

    function __construct($code = 200, $content = '', $size = 0) {

        $this->_status_code = $code;
        $this->_size = $size;
        $this->_content = $content;
    }

    public function __toString() {
        return $this->_content;
    }

    public function getContent() {
        return $this->_content;
    }

    public function getSize() {
        return $this->_size;
    }

    public function getStatusCode() {
        return $this->_status_code;
    }
}