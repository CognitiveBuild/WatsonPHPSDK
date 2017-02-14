<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 14/02/2017
 * Time: 13:56 PM
 */
namespace WatsonSDK\Common;
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
    protected $_pa;
    public function __construct()
    {
        $this->setUrl("https://gateway.watsonplatform.net");
        $this->setMethod('POST');
    }
    protected function setUrl($url){
        $this->_url=$url;
    }
    protected function setUri($uri){
        $this->_uri=$uri.($this->_version!=null?'?version='.$this->_version:'');
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
    protected function toneGet(){
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

    protected function tonePost(){
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
    protected function urlParam(){
        return $this->_uri.'&text='.$this->_text;
    }
}