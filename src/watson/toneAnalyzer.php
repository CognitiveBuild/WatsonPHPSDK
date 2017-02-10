<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 09/02/2017
 * Time: 9:53 AM
 */
namespace watson\service;

class ToneAnalyzer{
    private $_url="https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone",$_urlPa;
    private $_version="2016-05-19";
    private $_request,$_http;
    private $_text;
    private $_method;
    private $_user,$_pass;
    private $_pa;
    public function __construct($user=null,$pass=null,$text=null)
    {
        $this->_urlPa=$this->_url.'?version='.$this->_version;
        $this->_user=$user;
        $this->_pass=$pass;
        $this->_text=$text;
    }
    public function setUrl($url){
        $this->_url=$url;
    }
    public function setVersion($pa){
            $this->_version=$pa;
    }
    public function setText($pa){
            $this->_text=$pa;
    }
    public function setAuth($user,$pass){
            $this->_user=$user;
            $this->_pass=$pass;

    }
    public function setMethod($method){
        $this->_method=$method;
    }

    public function toneGet(){
        if($this->_text!=null){
            $this->_urlPa=$this->urlWithParam();
        }
        $this->_request=new HttpClient($this->_urlPa);
        $this->_request->basicAuth($this->_user,$this->_pass);
        $this->_request->get();
        return $this->_request->getBody();
    }

    public function tonePost(){
        if($this->_text!=null){
            $this->_urlPa=$this->urlWithParam();
            $this->_pa=array('text'=>$this->_text);
        }
        $this->_request=new HttpClient($this->_urlPa);
        $this->_request->setHeader('Content-Type','application/json');
        $this->_request->basicAuth($this->_user,$this->_pass);
        $this->_request->post('/tone-analyzer/api/v3/tone?version=2016-05-19',json_encode($this->_pa));
        return $this->_request->getBody();
    }
    private function urlWithParam(){
        return $this->_urlPa.'&text='.$this->_text;
    }
}