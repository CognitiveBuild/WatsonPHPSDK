# ToneAnalyzer

*** 
> public class ToneAnalyzer

The IBM Watson Tone Analyzer service uses linguistic analysis to detect emotional tones, social propensities, and writing styles in written communication. Then it offers suggestions to help the writer improve their intended language tones.

***  

```
function __construct(WatsonCredential $credential)
```

Init the ToneAnalyzer of the given instance of `WatsonCredential`.

```
public function Tone(ToneAnalyzerModel $model)
```

Analyze the tone of the given instance of `ToneAnalyzerModel`.
###Usage
```
$analyzer = new ToneAnalyzer(WatsonCredential::initWithCredentials('your username', 'your password'));  

$model    = new ToneAnalyzerModel();

$model->setText('I am so happy!');
$model->setTones('social');
$result = $analyzer->Tone($model);
```
