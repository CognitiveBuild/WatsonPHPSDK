<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 14/02/2017
 * Time: 13:56 PM
 */
namespace WatsonSDK\Service;
require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
class HttpClient{
    protected $_url,$_uri;
    protected $_version;
    protected $_request;
    protected $_text;
    protected $_method;
    protected $_user,$_pass,$_token;
    protected $_param;
    public function __construct(){

    }
    protected function setUrl($url){
        $this->_url=$url;
    }
    protected function setUri($uri){
        $this->_uri=$uri.($this->_version!=null?'?version='.$this->_version:'');
    }
    protected function getUri(){
        return $this->_uri;
    }
    protected function setVersion($pa){
        $this->_version=$pa;
    }
    protected function setText($pa){
        $this->_text=$pa;
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
                return Psr7\str($e->getResponse());
            }
            else
                return Psr7\str($e->getRequest());
        }

        return (string)$response->getBody();
    }
}