# ToneAnalyzerModel

> public class ToneAnalyzerModel

The IBM Watson Tone Analyzer entity class used to config Parameters such as $text,$tones,$version,$sentences

--- 

```php
function __construct($text = '', $tones = NULL, $sentences = NULL, $version = '2016-05-19')
```
Init the ToneAnalyzerModel.
###Parameters

| Parameter | Description |
| --------- |-------------|
| text      | Text that contains the content to be analyzed. The Tone Analyzer Service supports up to 128KB of text, or about 1000 sentences. Sentences with less than three words cannot be analyzed. |
| tones     | Filter the results by a specific tone. Valid values for tones are emotion, language, and social.      |
| sentences | Filter your response to remove the sentence level analysis. Valid values for sentences are true and false. This parameter defaults to true when it's not set, which means that a sentence level analysis is automatically provided. Change sentences=false to filter out the sentence level analysis.       |
| version   | The release date of the version of the API to use. Specify the date in “YYYY-MM-DD” format.      |

###Getter and Setter
```php
    /**
     * Get text
     * @return string
     */
    public function getText();

    /**
     * Set text
     * @param $val
     */
    public function setText($val);

    /**
     * Get tones
     * @return string
     */
    public function getTones();

    /**
     * Set tones
     * @param $val
     */
    public function setTones($val);

    /**
     * Get sentences
     * @return string
     */
    public function getSentences();

    /**
     * Set sentences
     * @param $val
     */
    public function setSentences($val);

    /**
     * Get version
     * @return string
     */
    public function getVersion();

    /**
     * Set version
     * @param $val
     */
    public function setVersion($val);
```
## License
Copyright 2017 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
