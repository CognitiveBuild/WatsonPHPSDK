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

class ServiceModel {

    // Username
    private $_username;
    // Password
    private $_password;
    // Token provider
    private $_token_provider;

    /**
     * Get username
     * @return string
     */
    public function getUsername() {
        return $this->_username;
    }

    /**
     * Set username
     * @param $val
     */
    public function setUsername($val) {
        $this->_username = $val;
    }

    /**
     * Get password
     * @return string
     */
    public function getPassword() {
        return $this->_password;
    }

    /**
     * Set password
     * @param $val
     */
    public function setPassword($val) {
        $this->_password = $val;
    }

    /**
     * Get token provider
     * @return TokenProviderInterface
     */
    public function getTokenProvider() {
        return $this->_token_provider;
    }

    /**
     * Set token provider
     * @param $val TokenProviderInterface
     */
    public function setTokenProvider(TokenProviderInterface $val) {
        $this->_token_provider = $val;
    }

    /**
     * Generate request data
     * @return string
     */
    public function getData() {

        $vars = get_object_vars($this);

        foreach($vars as $key => $value) {

            if(is_null($value) || substr($key, 0, 1) === '_') {
                unset($vars[$key]);
            }
        }

        return $vars;
    }
}