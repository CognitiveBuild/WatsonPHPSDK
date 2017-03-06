# Watson PHP SDK

[![Language: PHP](https://img.shields.io/badge/php-5.6+-orange.svg?style=flat)](http://php.net/)
[![Build Status](https://travis-ci.org/CognitiveBuild/WatsonPHPSDK.svg?branch=master)](https://travis-ci.org/CognitiveBuild/WatsonPHPSDK)
[![codecov](https://codecov.io/gh/CognitiveBuild/WatsonPHPSDK/branch/master/graph/badge.svg)](https://codecov.io/gh/CognitiveBuild/WatsonPHPSDK)

Watson PHP SDK for IBM Watson Developer Cloud

## Installation

Installing [Composer](http://getcomposer.org) will be easier to manage dependencies for your application.

Run the Composer command to install the latest version of the Watson PHP SDK:

```shell
composer require cognitivebuild/watsonphpsdk:dev-master
```

If the Watson PHP SDK is downloaded from GitHub already, run the update command:
```shell
composer update
```

Include `autoload.php` in your application:

```php
require 'vendor/autoload.php';
```

## Namespaces
For common use, one of the namespaces of `WatsonCredential` or `SimpleTokenProvider` can be optional, depends on how to invoke the Watson services, and you can reference the classes like so:
```php
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Services\ToneAnalyzer;
use WatsonSDK\Services\ToneAnalyzerModel;
```

## API Reference
Please [visit our wiki](https://github.com/CognitiveBuild/WatsonPHPSDK/wiki).

## Services
* [Tone Analyzer](#tone-analyzer)

## Tone Analyzer
The IBM Watson Tone Analyzer service can be used to discover, understand, and revise the language tones in text. The service uses linguistic analysis to detect three types of tones from written text: emotions, social tendencies, and writing style.

Emotions identified include things like anger, fear, joy, sadness, and disgust. Identified social tendencies include things from the Big Five personality traits used by some psychologists. These include openness, conscientiousness, extraversion, agreeableness, and emotional range. Identified writing styles include confident, analytical, and tentative.

The following example demonstrates how to use the Tone Analyzer service by using credentials:

```php
$analyzer = new ToneAnalyzer( WatsonCredential::initWithCredentials('your_username', 'your_password') );
```

or invoke Tone Analyzer API using token, the `SimpleTokenProvider` is a sample of TokenProvider, we recommend you to implement your own Token Provider, by implementing the `TokenProviderInterface`.
```php
$tokenProvider = new SimpleTokenProvider('https://your-token-factory-url');
$analyzer = new ToneAnalyzer( WatsonCredential::initWithTokenProvider( $tokenProvider ) );
```

Place the content to be analyzed, call the Tone API and check the result: 
```php
$model  = new ToneAnalyzerModel();
$model->setText('your text to be analyzed.');

$result = $analyzer->Tone($model);

// View results
echo $result->getContent();
```

## License
Copyright 2017 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
