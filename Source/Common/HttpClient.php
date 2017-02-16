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
namespace WatsonSDK\Service;
require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
class HttpClient{
    protected $_url,$_uri;
    protected $_request;
    protected $_method;
    protected $_user,$_pass,$_token;
    protected $_param;
    public function __construct(){

    }
    protected function setUrl($url){
        $this->_url=$url;
    }
    protected function setUri($uri){
        $this->_uri=$uri;
    }
    protected function getUri(){
        return $this->_uri;
    }
    protected function setUser($user){
        $this->_user=$user;
    }
    protected function getUser(){
        return $this->_user;
    }
    protected function setPass($pass){
        $this->_pass=$pass;
    }
    protected function setAuth($user,$pass){
        $this->_user=$user;
        $this->_pass=$pass;

    }
    protected function setMethod($method){
        $this->_method=$method;
    }
    protected function getMethod(){
        return $this->_method;
    }
    protected function setParam($param){
        $this->_param=$param;
    }
    protected function getParam(){
        return $this->_param;
    }
    protected function request(){
        $this->_request=new Client(['base_uri' => $this->_url]);
        try{
            $response=$this->_request->request($this->getMethod(), $this->getUri(), $this->getParam());
        }catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
            else
                return $e->getRequest();
        }

        return $response;
    }
}