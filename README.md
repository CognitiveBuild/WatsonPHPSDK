# Watson PHP SDK

[![Language: PHP](https://img.shields.io/badge/php->=5.6-orange.svg?style=flat)](http://php.net/)
[![Build Status](https://travis-ci.org/CognitiveBuild/WatsonPHPSDK.svg?branch=master)](https://travis-ci.org/CognitiveBuild/WatsonPHPSDK)
[![codecov](https://codecov.io/gh/CognitiveBuild/WatsonPHPSDK/branch/master/graph/badge.svg)](https://codecov.io/gh/CognitiveBuild/WatsonPHPSDK)

Watson PHP SDK for IBM Watson Developer Cloud

##Installation

The recommended way to install Watson PHP SDK is through [Composer](http://getcomposer.org).

```shell
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Run the Composer command to install the latest version of the Watson PHP SDK:

```shell
php composer.phar require CognitiveBuild/WatsonPHPSDK:master
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

##Usage

```php
// Using WatsonSDK\Services\ToneAnalyzer namespace
use WatsonSDK\Services\ToneAnalyzer;

$analyzer = new ToneAnalyzer();
$model    = new ToneAnalyzerModel();
```

Invoke Tone Analyzer API using credentials, 
```php
$model->setUsername('your_username');
$model->setPassword('your_password');
```

or invoke Tone Analyzer API using token, the `SimpleTokenProvider` is a sample of TokenProvider, we recommend you to implement your own Token Provider, by implementing the `TokenProviderInterface`
```php
$model->setTokenProvider( new SimpleTokenProvider('https://your-token-factory-url') );
```

Place the content to be analyzed, call the Tone API and check the result: 
```php
$model->setText('your text to be analyzed');
$result = $analyzer->Tone($model);

// View results
echo $result->getContent();
```

##License
Copyright 2016 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
