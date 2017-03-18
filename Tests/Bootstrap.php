<?php
require __DIR__ . '/Environment.php';
require __DIR__ . '/BaseTestCase.php';
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('WatsonSDK\\Tests\\', __DIR__);