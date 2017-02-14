<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 13/02/2017
 * Time: 1:58 PM
 */

require 'watson.inc.php';
//require 'vendor/autoload.php';
//
//require __DIR__.'/src/ToneAnalyzer/ToneAnalyzertest.php';
use WatsonSDK\Service\ToneAnalyzer\ToneAnalyzer;
//$tone=new ToneAnalyzer('d1de1690-36ae-4b5c-b092-2539ca5f2c03','PlH1lAYFUfnB','this is beautiful');
//$tone=new \Watson\Service\ToneAnalyzer();
//Use post method to toneAnalyzer service.
//var_dump('test');
//Use get method to toneAnalyzer service.
//var_dump($tone->tonePost());

//use WatsonSDK\Service\ToneAnalyzertest;

$tone=new ToneAnalyzer();
//$tone=new ToneAnalyzertest();
print_r($tone->Tone('d1de1690-36ae-4b5c-b092-2539ca5f2c03','PlH1lAYFUfnB','this is beautiful'));
