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
use WatsonSDK\Service\TokenInterface;
use WatsonSDK\Service\HttpClient;
require('Source/Common/TokenInterface.php');
class demoToken extends HttpClient implements TokenInterface{
    protected $_token;
    protected $_service;
    public function __construct($param=null,$user=null,$pass=null)
    {
      $this->init($param,$user,$pass);
    }
    public function setToken($token){
    $this->_token=$token;
    }
    public function getToken(){
        return $this->_token;
    }
    function obtainToken($param, $user, $pass,$fileName)
    {
        // TODO: Implement getToken() method.

        try{
            if(!file_exists($fileName)){
                file_put_contents($fileName,'');
                $this->updateToken($param, $user, $pass,$fileName);
            }
            $json_token = file_get_contents($fileName);
        }catch(\Exception $e){
            return $e->getMessage();
        }


        $this->setToken(json_decode($json_token, true)['token']) ;
        return $this->getToken();

    }
    function updateToken($param, $user, $pass,$fileName){
        $this->init($param,$user,$pass);
        $pa=array();
        if($user!=null&&$pass!=null){
            $this->setAuth($user,$pass);
            $pa['auth']=[$user,$pass];
        }
        if($pa!=null){
            $this->setParam($pa);
        }
        $this->urlParam();
        $this->setMethod('GET');
        try{
            $response=$this->request();
            if($response->getStatusCode()==200){

                $this->setToken((string)$response->getBody());
                $json_token = json_encode(['token'=>$this->getToken()]);
                file_put_contents($fileName, $json_token);
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }


        return $this->getToken();
    }
    protected function init($param=null,$user=null,$pass=null){
        $this->setUrl("https://gateway.watsonplatform.net");
        $this->setMethod('GET');
        $this->setUri("/authorization/api/v1/token");
        $this->_user=$user;
        $this->_pass=$pass;
        $this->_service=$param;

    }
    protected function urlParam(){
        $this->setUri($this->_uri.'?url='.$this->_service);
    }
}