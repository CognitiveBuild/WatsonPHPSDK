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
class ToneAnalyzer extends HttpClient{
    protected $_tokenProvider;
    protected $_text;
    protected $_version;
    protected $_fileName;
    public function __construct($user=null,$pass=null,$text=null,$version=null)
    {
        parent::__construct();
        if($version!=null)
            $this->setVersion($version);
        else
            $this->setVersion("2016-05-19");
        $this->setUrl("https://gateway.watsonplatform.net");
        $this->setMethod('POST');
        $this->setUri("/tone-analyzer/api/v3/tone?version=".$this->getVersion());
        $this->_user=$user;
        $this->_pass=$pass;
        $this->_text=$text;
    }
    protected function setText($pa){
        $this->_text=$pa;
    }
    protected function getText(){
        return $this->_text;
    }
    protected function setVersion($pa){
        $this->_version=$pa;
    }
    protected function getVersion(){
        return $this->_version;
    }
    protected function setTokenProvider($tokenProvider){
        $this->_tokenProvider=new $tokenProvider();
    }
    protected function setFileName($fileName){
        $this->_fileName=$fileName;
    }
    protected function getFileName(){
        return $this->_fileName;
    }

    public function Tone($user=null,$pass=null,$text=null,$version=null,$method=null){
        $pa=array();
        if($user!=null&&$pass!=null){
            $this->setAuth($user,$pass);
            $pa['auth']=[$user,$pass];
        }
        if($text!=null){
            $this->setText($text);
        }
        if($version!=null){
            $this->setVersion($version);
        }
        if($method!=null){
            $this->setMethod($method);
        }
        if($this->getMethod()=='POST'){
            $pa['json']=['text'=>$text];
        }else if($this->getMethod()=='GET'){
            $this->urlParam();
        }
        if($pa!=null){
            $this->setParam($pa);
        }
        return $this->request();
    }
    public function ToneTest($config){
        $pa=array();
        $this->init($config);
        $this->getMethod()=='POST'?$pa['json']=['text'=>$this->getText()]: $this->urlParam();
        if($this->_tokenProvider!=null)
        {
            $pa['headers']['X-Watson-Authorization-Token']=$this->_tokenProvider->obtainToken($this->_url.$this->_uri,$this->_user,$this->_pass,$this->_fileName);
            $pa['json']=['text'=>$this->getText()];
        }

        else{
            $pa['auth']=[$this->_user,$this->_pass];
        }
        if($pa!=null){
            $this->setParam($pa);
        }
        $response=$this->request();
        if($this->_tokenProvider!=null&&$response->getStatusCode()!='200'){
            $pa['headers']['X-Watson-Authorization-Token']=$this->_tokenProvider->updateToken($this->_url.$this->_uri,$this->_user,$this->_pass,$this->_fileName);
            $this->setParam($pa);
            $response=$this->request();
        }
        return (string)$response->getBody();
    }

    protected function init($config){
        if(array_key_exists('user',$config)&&$config['user']!='')
            $this->setUser($config['user']);
        if(array_key_exists('pass',$config)&&$config['pass']!='')
            $this->setPass($config['pass']);
        if(array_key_exists('text',$config)&&$config['text']!='')
            $this->setText($config['text']);
        if(array_key_exists('url',$config)&&$config['url']!='')
            $this->setUrl($config['url']);
        if(array_key_exists('uri',$config)&&$config['uri']!='')
            $this->setUri($config['uri']);
        if(array_key_exists('version',$config)&&$config['version']!='')
            $this->setVersion($config['version']);
        if(array_key_exists('fileName',$config)&&$config['fileName']!='')
            $this->setFileName($config['fileName']);
        if(array_key_exists('method',$config)&&$config['method']!='')
            $this->setMethod($config['method']);
        if(array_key_exists('tokenProvider',$config)&&$config['tokenProvider']!='')
            $this->setTokenProvider($config['tokenProvider']);
    }
    protected function urlParam(){
        $this->setUri($this->_uri.'&text='.$this->_text);
    }
}
