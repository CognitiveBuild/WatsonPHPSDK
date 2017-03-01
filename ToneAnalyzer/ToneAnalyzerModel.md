# ToneAnalyzerModel

*** 
> public class ToneAnalyzerModel

The IBM Watson Tone Analyzer entity class used to config Parameters such as $text,$tones,$version,$sentences
***  

```
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
```
 /**
     * Get text
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Set text
     * @param $val
     */
    public function setText($val) {
        $this->text = $val;
    }

    /**
     * Get tones
     * @return string
     */
    public function getTones() {
        return $this->_tones;
    }

    /**
     * Set tones
     * @param $val
     */
    public function setTones($val) {
        $this->_tones = $val;
    }

    /**
     * Get sentences
     * @return string
     */
    public function getSentences() {
        return $this->_sentences;
    }

    /**
     * Set sentences
     * @param $val
     */
    public function setSentences($val) {
        $this->_sentences = $val;
    }

    /**
     * Get version
     * @return string
     */
    public function getVersion() {
        return $this->_version;
    }

    /**
     * Set version
     * @param $val
     */
    public function setVersion($val) {
        $this->_version = $val;
    }
```
