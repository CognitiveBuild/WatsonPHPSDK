<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 08/02/2017
 * Time: 2:15 PM
 */

require_once 'watson.inc.php';

use watson\service\ToneAnalyzer;
$tone=new ToneAnalyzer('d1de1690-36ae-4b5c-b092-2539ca5f2c03','PlH1lAYFUfnB','A%20word%20is%20dead%20when%20it%20is%20said,%20some%20say.%20Emily%20Dickinson');

//Use post method to toneAnalyzer service.
var_dump($tone->tonePost());
//Use get method to toneAnalyzer service.
//var_dump($tone->toneGet());


