<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 09/02/2017
 * Time: 9:53 AM
 */
namespace Watson\Service;
require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class ToneAnalyzer{
    private $_url="https://gateway.watsonplatform.net",$_uri="/tone-analyzer/api/v3/tone";
    private $_version="2016-05-19";
    private $_request;
    private $_text;
    private $_method;
    private $_user,$_pass;
    private $_pa;
    public function __construct($user=null,$pass=null,$text=null,$version=null)
    {
        if($version!=null){
            $this->_version=$version;
        }
        $this->_uri=$this->_uri.'?version='.$this->_version;
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
            $this->_uri=$this->urlParam();
        }
        $this->_request=new Client(['base_uri' => $this->_url]);
        try{
            $response=$this->_request->request('GET', $this->_uri, [
                'auth' => [$this->_user, $this->_pass]
            ]);
        }catch (RequestException $e) {
            if ($e->hasResponse()) {
                return Psr7\str($e->getResponse());
            }
            else
                return Psr7\str($e->getRequest());
        }

        return (string)$response->getBody();
    }

    public function tonePost(){
        $this->_request=new Client(['base_uri' => $this->_url]);
        try {
            $response=$this->_request->request('POST', $this->_uri, [
                'auth' => [$this->_user, $this->_pass],
                'json' => ['text' => $this->_text]
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return Psr7\str($e->getResponse());
            }
            else
                return Psr7\str($e->getRequest());
        }
        return (string)$response->getBody();
    }
    private function urlParam(){
        return $this->_uri.'&text='.$this->_text;
    }
}