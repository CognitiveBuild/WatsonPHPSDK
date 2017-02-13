# Watson PHP SDK
Watson PHP SDK for IBM Watson Developer Cloud
## Installing WatsonPHPSdk

The recommended way to install WatsonPHPSdk is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of WatsonPHPSdk:

```bash
php composer.phar require cognitivebuild/watsonphpsdk
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## Issues:
1,if you use https request,and got the SSL issue as below

`CURL error 6-:SSL certificate:unable to get local issuer certificate.`

- Perfect solution:Change your curl to SSL version.

- Minor solution: access(https://curl.haxx.se/docs/caextract.html),download the cacert.pem file,modify your php.ini.
find field "curl.cainfo".change it as below and restart your server after then.
```php
 curl.cainfo = "your saved path\cacert.pem"
```

## Usage.
#### 1.Tone Analyzer
```php
require 'vendor/autoload.php';

use watson\service\ToneAnalyzer;
$tone=new ToneAnalyzer('yourusername','yourpassword','yourtext');

//Use post method to toneAnalyzer service.
var_dump($tone->tonePost());
//Use get method to toneAnalyzer service.
var_dump($tone->toneGet());
```


##License
Copyright 2016 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
