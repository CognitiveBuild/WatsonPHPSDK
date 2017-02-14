<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 09/02/2017
 * Time: 9:53 AM
 */
namespace WatsonSDK\Service\ToneAnalyzer;
require_once 'vendor/autoload.php';
use WatsonSDK\Common\HttpClient;
class ToneAnalyzer extends HttpClient{
    public function __construct($user=null,$pass=null,$text=null,$version=null)
    {
        parent::__construct();
        if($version!=null)
            $this->setVersion($version);
        else
            $this->setVersion("2016-05-19");
        $this->setUri("/tone-analyzer/api/v3/tone");
        $this->_user=$user;
        $this->_pass=$pass;
        $this->_text=$text;
    }
    public function Tone($user=null,$pass=null,$text=null,$version=null,$method=null){
        if($user!=null&&$pass!=null){
            $this->setAuth($user,$pass);
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
        if($this->getMethod()=='GET'){
            return $this->toneGet();
        }

        else
            return $this->tonePost();
    }
}
