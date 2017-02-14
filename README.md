# Watson PHP SDK
Watson PHP SDK for IBM Watson Developer Cloud

##Installation

The recommended way to install Watson PHP SDK is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Run the Composer command to install the latest version of the Watson PHP SDK:

```bash
php composer.phar require CognitiveBuild/WatsonPHPSDK:master
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

##Usage
####Tone Analyzer
```php
// Using WatsonSDK\Service\ToneAnalyzer namespace
use WatsonSDK\Service\ToneAnalyzer;

$toneAnalyzer = new ToneAnalyzer();
$result = $toneAnalyzer->Tone('your_username', 'your_password', 'text to be analyzed');
var_dump($result);
```

##Issues
- If you use https request,and got the SSL issue as below

 `CURL error 6-:SSL certificate:unable to get local issuer certificate.`
- Solutions
  - Change your cURL to SSL version
  - Minor solution: access(https://curl.haxx.se/docs/caextract.html), download the cacert.pem file, modify your php.ini, find field `curl.cainfo`, then change it as below and restart your server

    ```php
curl.cainfo = "your saved path\cacert.pem"
    ```

##License
Copyright 2016 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
