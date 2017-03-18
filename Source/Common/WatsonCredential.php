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

class WatsonCredential {

    // Username
    private $_username;
    // Password
    private $_password;
    // Token provider
    private $_token_provider;
    // Token
    private $_token;

    /**
     * WatsonCredential constructor
     * 
     * @param $username string | NULL
     * @param $password string | NULL
     */
    function __construct($username = NULL, $password = NULL) {

        $this->setUsername($username);
        $this->setPassword($password);
    }

    /**
     * An alternative way of initializing WatsonCredential instance
     * 
     * @param $username string
     * @param $password string
     * 
     * @return WatsonCredential
     */
    final public static function initWithCredentials($username, $password) {

        $credential = new WatsonCredential($username, $password);
        return $credential;
    }

    /**
     * Use token provider to initialize a WatsonCredential instance
     * 
     * @param $_token_provider TokenProviderInterface
     * 
     * @return WatsonCredential
     */
    final public static function initWithTokenProvider(TokenProviderInterface $token_provider) {

        $credential = new WatsonCredential();
        $credential->setTokenProvider($token_provider);
        return $credential;
    }

    /**
     * Get username
     * @return string
     */
    public function getUsername() {
        return $this->_username;
    }

    /**
     * Set username
     * @param $val string
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
     * @param $val string
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
     * Get token string
     * @param $val string
     */
    public function getToken() {
        return $this->_token;
    }

    /**
     * Set token
     * @param $val string
     */
    public function setToken($token) {
        $this->_token = $token;
    }

}