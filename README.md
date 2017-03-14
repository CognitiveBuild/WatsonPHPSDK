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
* [Natural Language Understanding](#natural-language-understanding)
* [Personality Insights](#personality-insights)

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

$result = $analyzer->getTone($model);

// View results
echo $result->getContent();
```

## Natural Language Understanding
Analyze text to extract meta-data from content such as concepts, entities, keywords, categories, sentiment, emotion, relations, semantic roles, using natural language understanding. With custom annotation models developed using Watson Knowledge Studio, identify industry/domain specific entities and relations in unstructured text.

The following example demonstrates how to use the Natural Language Understanding:
```php
$nlu = new NaturalLanguageUnderstanding( WatsonCredential::initWithCredentials('your_username', 'your_password') );
```

List available custom models:
```php
$result = $nlu->listModels();

// View results
echo $result->getContent();
```

Delete a custom model:
```php
$result = $nlu->deleteModels('your_custom_model_id');

// View results
echo $result->getContent();
```

Analyze features of natural language content: 
```php
$model = new NaturalLanguageUnderstandingModel('Watson PHP SDK for IBM Watson Developer Cloud.', [ 'keywords' => [ 'limit' => 5 ] ]);
$result = $nlu->analyze($model);

// View results
echo $result->getContent();
```

## Personality Insights
Personality Insights extracts personality characteristics based on how a person writes. You can use the service to match individuals to other individuals, opportunities, and products, or tailor their experience with personalized messaging and recommendations. Characteristics include the Big 5 Personality Traits, Values, and Needs. At least 1200 words of input text are recommended when using this service.

The following example demonstrates how to use the Personality Insights service:

```php
$insights = new PersonalityInsights( WatsonCredential::initWithCredentials('your_username', 'your_password') );
$model    = new PersonalityInsightsModel('Enter more than 100 unique words here...');
$mode->setConsumptionPreferences(TRUE);
$result   = $insights->getProfile($model);

// View results
echo $result->getContent();
```

## Token based authentication
Refer to the samples of [Tone Analyzer](#tone-analyzer) about how to invoke the service by using TokenProvider.

## License
Copyright 2017 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
