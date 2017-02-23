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

namespace WatsonSDK\Samples;

use WatsonSDK\Common\ServiceModel;

/**
 * Token Service entity class
 * 
 * @todo: Properties to be sent to the services need to be protected
 */
class TokenServiceModel extends ServiceModel {

    const BASE_URL = 'https://gateway.watsonplatform.net/authorization/api/v1';


    // When we make breaking changes to the API, we release a new, dated version.
    // The value for the version parameter is the date for the version of the API that you want to call.
    // The current version is 2016-05-19, and the documentation reflects the current version.
    private $_url;

    function __construct($url = '') {
        $this->_url = $url;
    }

    /**
     * Get url
     * @return string
     */
    public function getUrl() {
        return $this->_url;
    }

    /**
     * Set url
     * @param $val
     */
    public function setUrl($val) {
        $this->_url = $val;
    }
}