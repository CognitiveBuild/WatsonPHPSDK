<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 09/02/2017
 * Time: 9:53 AM
 */
namespace Watson\Service;
//require_once 'vendor/autoload.php';
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
    private function setUrl($url){
        $this->_url=$url;
    }
    private function setVersion($pa){
            $this->_version=$pa;
    }
    private function setText($pa){
            $this->_text=$pa;
    }
    private function setAuth($user,$pass){
            $this->_user=$user;
            $this->_pass=$pass;

    }
    private function setMethod($method){
        $this->_method=$method;
    }

    private function toneGet(){
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

    private function tonePost(){
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
    public function Tone($user=null,$pass=null,$text=null,$version=null){
        if($user!=null&&$pass!=null){
            $this->setAuth($user,$pass);
        }
        if($text!=null){
            $this->setText($text);
        }
        if($version!=null){
            $this->setVersion($version);
        }
        if($this->_version=='GET'){
            return $this->toneGet();
        }

        else
            return $this->tonePost();
    }
    private function urlParam(){
        return $this->_uri.'&text='.$this->_text;
    }
}