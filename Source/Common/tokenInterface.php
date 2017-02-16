<?php
/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 16/02/2017
 * Time: 8:59 AM
 */
namespace WatsonSDK\Service;
interface tokenInterface{
    public function obtainToken($param,$user,$pass,$fileName);
    public function updateToken($param,$user,$pass,$fileName);
}