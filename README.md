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
use WatsonSDK\Services\ToneAnalyzer\ToneModel;
```

## API Reference
Please [visit our wiki](https://github.com/CognitiveBuild/WatsonPHPSDK/wiki).

## Services
* [Tone Analyzer](#tone-analyzer)
* [Natural Language Classifier](#natural-language-classifier)
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
$model = new ToneModel();
$model->setText('your text to be analyzed.');
$result = $analyzer->getTone($model);
echo $result->getContent();
```

## Natural Language Classifier
The IBM Watson™ Natural Language Classifier service uses machine learning algorithms to return the top matching predefined classes for short text input. You create and train a classifier to connect predefined classes to example texts so that the service can apply those classes to new inputs.

The following example demonstrates how to use the Natural Language Classifier:
```php
$nlc = new NaturalLanguageClassifier( WatsonCredential::initWithCredentials('your_username', 'your_password') );
$result = $nlc->classify('your text to be classified.', 'your classifier id');
echo $result->getContent();
```

## Natural Language Understanding
Analyze text to extract meta-data from content such as concepts, entities, keywords, categories, sentiment, emotion, relations, semantic roles, using natural language understanding. With custom annotation models developed using Watson Knowledge Studio, identify industry/domain specific entities and relations in unstructured text.

The following example demonstrates how to use the Natural Language Understanding:

```php
$nlu = new NaturalLanguageUnderstanding( WatsonCredential::initWithCredentials('your_username', 'your_password') );
$model = new AnalyzeModel('Watson PHP SDK for IBM Watson Developer Cloud.', [ 'keywords' => [ 'limit' => 5 ] ]);
$result = $nlu->analyze($model);
echo $result->getContent();
```

## Personality Insights
Personality Insights extracts personality characteristics based on how a person writes. You can use the service to match individuals to other individuals, opportunities, and products, or tailor their experience with personalized messaging and recommendations. Characteristics include the Big 5 Personality Traits, Values, and Needs. At least 1200 words of input text are recommended when using this service.

The following example demonstrates how to use the Personality Insights service:

```php
$insights = new PersonalityInsights( WatsonCredential::initWithCredentials('your_username', 'your_password') );
$model = new ProfileModel( new ContentItemModel('Enter more than 100 unique words here...'));
$mode->setConsumptionPreferences(TRUE);
$result = $insights->getProfile($model);
echo $result->getContent();
```

## API response
All of the service responses are wrapped in `HttpResponse` class instead of original format of response, so it will be easy for you to use your own HttpClient if necessory.
Once there is a result from Watson APIs, there are three common methods you can leverage:
```php
// Get HTTP status code
public function getStatusCode();
// Get actual size of response content
public function getSize();
// Get the content of the response
public function getContent();
```

We use `Tone Analyzer` for instance:
```php
$analyzer = new ToneAnalyzer(...);
// getTone will return HttpResponse type
$result = $analyzer->getTone('your text to be analyzed.');

var_dump($result->getStatusCode());
var_dump($result->getSize());
var_dump($result->getContent());

// Also there is another way under string context
// You can use $result as the response content instead of using $result->getContent();.
echo $result;
```

## Token based authentication
Refer to the samples of [Tone Analyzer](#tone-analyzer) about how to invoke the service by using TokenProvider.

## License
Copyright 2017 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
