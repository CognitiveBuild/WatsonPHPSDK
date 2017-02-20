# Watson PHP SDK

[![Language: PHP](https://img.shields.io/badge/php-5.6+-orange.svg?style=flat)](http://php.net/)
[![Build Status](https://travis-ci.org/CognitiveBuild/WatsonPHPSDK.svg?branch=master)](https://travis-ci.org/CognitiveBuild/WatsonPHPSDK)
[![codecov](https://codecov.io/gh/CognitiveBuild/WatsonPHPSDK/branch/master/graph/badge.svg)](https://codecov.io/gh/CognitiveBuild/WatsonPHPSDK)

Watson PHP SDK for IBM Watson Developer Cloud

## Installation

#### Dependency Management

We recommend installing [Composer](http://getcomposer.org) to manage dependencies for your application.

You can install Composer with curl: 
```shell
curl -sS https://getcomposer.org/installer | php
```

Run the Composer command to install the latest version of the Watson PHP SDK:

```shell
php composer.phar require CognitiveBuild/WatsonPHPSDK:master
```

After installation, include `autoload.php`:

```php
require 'vendor/autoload.php';
```

## Services
* [Tone Analyzer](#tone-analyzer)

## Tone Analyzer
The IBM Watson Tone Analyzer service can be used to discover, understand, and revise the language tones in text. The service uses linguistic analysis to detect three types of tones from written text: emotions, social tendencies, and writing style.

Emotions identified include things like anger, fear, joy, sadness, and disgust. Identified social tendencies include things from the Big Five personality traits used by some psychologists. These include openness, conscientiousness, extraversion, agreeableness, and emotional range. Identified writing styles include confident, analytical, and tentative.

The following example demonstrates how to use the Tone Analyzer service:

```php
use WatsonSDK\Services\ToneAnalyzer;
use WatsonSDK\Services\ToneAnalyzerModel;

$analyzer = new ToneAnalyzer();
$model    = new ToneAnalyzerModel();
```

Invoke Tone Analyzer API using credentials, 
```php
$model->setUsername('your_username');
$model->setPassword('your_password');
```

or invoke Tone Analyzer API using token, the `SimpleTokenProvider` is a sample of TokenProvider, we recommend you to implement your own Token Provider, by implementing the `TokenProviderInterface`.
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

## License
Copyright 2017 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
