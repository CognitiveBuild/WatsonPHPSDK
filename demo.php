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

require 'watson.inc.php';
//require 'vendor/autoload.php';
//
//require __DIR__.'/src/ToneAnalyzer/ToneAnalyzertest.php';
use WatsonSDK\Service\ToneAnalyzer;
//$tone=new ToneAnalyzer('d1de1690-36ae-4b5c-b092-2539ca5f2c03','PlH1lAYFUfnB','this is beautiful');
//$tone=new \Watson\Service\ToneAnalyzer();
//Use post method to toneAnalyzer service.
//var_dump('test');
//Use get method to toneAnalyzer service.
//var_dump($tone->tonePost());

//use WatsonSDK\Service\ToneAnalyzertest;
$config=array(
//    'url'=>'https://gateway.watsonplatform.net',
//    'uri'=>'/tone-analyzer/api/v3/tone',
//    'version'=>'2016-05-19',
    'tokenProvider'=>'WatsonSDK\Service\demoToken',
    'fileName'=>'token.json',
    'user'=>'d1de1690-36ae-4b5c-b092-2539ca5f2c03',
    'pass'=>'PlH1lAYFUfnB',
    'text'=>'this is beautiful',
    'method'=>'POST'
);
//$tone=new ToneAnalyzer();
//print_r($tone->Tone('d1de1690-36ae-4b5c-b092-2539ca5f2c03','PlH1lAYFUfnB','this is beautiful',null,'GET'));

//$token=new \WatsonSDK\Service\demoToken();
//var_dump($token->obtainToken('https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone','d1de1690-36ae-4b5c-b092-2539ca5f2c03','PlH1lAYFUfnB','token.json'));
$tone=new ToneAnalyzer();
var_dump($tone->ToneTest($config));