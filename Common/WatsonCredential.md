# WatsonCredential

> public class WatsonCredential

The IBM Watson WatsonCredential class used to config authentication such as $_username,$_password or $_token,$_token_Provider

---  

```
function __construct($username = NULL, $password = NULL)
```
Init the WatsonCredential.
###Parameters

| Parameter | Description |
| --------- |-------------|
| username  |The username used to authenticate with the service. |
| password  |The password used to authenticate with the service. |

```
 final public static function initWithCredentials($username, $password)
```

Init the credential with username and password.

```
final public static function initWithTokenProvider(TokenProviderInterface $token_provider)
```

Init the credential with token_provider.
###Parameters

| Parameter | Description |
| --------- |-------------|
| token_provider  |The token_provider used to authenticate with token,and the class need to implement TokenProviderInterface. |


###Getter and Setter
```
    /**
     * Get username
     * @return string
     */
    public function getUsername() {
        return $this->_username;
    }

    /**
     * Set username
     * @param $val string
     */
    public function setUsername($val) {
        $this->_username = $val;
    }

    /**
     * Get password
     * @return string
     */
    public function getPassword() {
        return $this->_password;
    }

    /**
     * Set password
     * @param $val string
     */
    public function setPassword($val) {
        $this->_password = $val;
    }

    /**
     * Get token provider
     * @return TokenProviderInterface
     */
    public function getTokenProvider() {
        return $this->_token_provider;
    }

    /**
     * Set token provider
     * @param $val TokenProviderInterface
     */
    public function setTokenProvider(TokenProviderInterface $val) {
        $this->_token_provider = $val;
    }

    /**
     * Get token string
     * @param $val string
     */
    public function getToken() {
        return $this->_token;
    }

    /**
     * Set token
     * @param $val string
     */
    public function setToken($token) {
        $this->_token = $token;
    }
```
## License
Copyright 2017 GCG GBS CTO Office under [the Apache 2.0 license](LICENSE).
