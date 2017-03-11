<?php

/**
 * Created by PhpStorm.
 * User: caopeng
 * Date: 10/03/2017
 * Time: 10:57 AM
 */

namespace WatsonSDK\Tests;

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Common\SimpleTokenHelper;
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\InvalidParameterException;
use PHPUnit\Framework\TestCase;
use WatsonSDK\Services\PersonalityInsights;
use WatsonSDK\Services\PersonalityInsightsModel;

class PersonalityInsightsTest extends TestCase{
    protected function setUp() {

        $env = new Environment(__DIR__);
        $env->load();
    }

    /**
     * PersonalityInsightsModel unit test
     */
    public function testPersonalityInsightsModel () {

        $model = new PersonalityInsightsModel();

        $this->assertInstanceOf(
            PersonalityInsightsModel::class,
            $model
        );

        $model->setContentItems('c');
        $model->setAcceptLanguage('al');
        $model->setAccept(true);
        $model->setConsumptionPreferences(true);
        $model->setContentLanguage('cl');
        $model->setCsvHeaders(true);
        $model->setRawScores(true);
        $model->setVersion('new-version');

        $this->assertEquals($model->getVersion(), 'new-version');
        $this->assertEquals($model->getAccept(), true);
        $this->assertEquals($model->getAcceptLanguage(), 'al');
        $this->assertEquals($model->getConsumptionPreferences(), true);
        $this->assertEquals($model->getContentItems(), 'c');
        $this->assertEquals($model->getContentLanguage(), 'cl');
        $this->assertEquals($model->getCsvHeaders(), true);
        $this->assertEquals($model->getRawScores(), true);

        $this->assertEquals($model->getData('@query'), [
            'raw_scores' => true,
            'consumption_preferences' => true,
            'version' => 'new-version',
            'csv_headers' => true
        ]);
        $this->assertEquals($model->getData('@header'), [
            'Content-Language' => 'cl',
            'Accept-Language' => 'al',
            'Accept' => true
        ]);
        $this->assertEquals($model->getData('@data'), [
            'contentItems' => 'c'
        ]);

    }

    /**
     * PersonalityInsights unit test with basic authentication
     */
    public function testPersonalityInsights() {

        $username = getenv('PERSONALITY_INSIGHTS_USERNAME');
        $password = getenv('PERSONALITY_INSIGHTS_PASSWORD');

        $insights= new PersonalityInsights(WatsonCredential::initWithCredentials($username, $password));
        $model    = new PersonalityInsightsModel();
        $model->setAcceptLanguage('zh-cn');

        $this->assertInstanceOf(
            PersonalityInsights::class,
            $insights
        );
        $contentItemsData=\GuzzleHttp\json_decode(file_get_contents(__DIR__ . './../Tests/data/contentitems.json'),true);
        $model->setContentItems($contentItemsData);

        if(isset($username) && isset($password)) {
            $result = $insights->Profile($model);
            $this->assertEquals(200, $result->getStatusCode());
            // @todo: evaluate $result->getContent();
        }
    }

    public function testTokenProvider() {

        $provider = new SimpleTokenProvider('https://phpsdk.mybluemix.net/token.php');
        $insights = new PersonalityInsights(WatsonCredential::initWithTokenProvider($provider));

        $model = new PersonalityInsightsModel();
        $contentItemsData=\GuzzleHttp\json_decode(file_get_contents(__DIR__ . './../Tests/data/contentitems.json'),true);
        $model->setContentItems($contentItemsData);
        $result = $insights->Profile($model);

        $this->assertEquals($result->getStatusCode(), 403);
    }

    public function testProfileWithTokenProvider() {

        try {
            $username = getenv('PERSONALITY_INSIGHTS_USERNAME');
            $password = getenv('PERSONALITY_INSIGHTS_PASSWORD');
            $token = $this->getToken($username, $password);

            $provider = new SimpleTokenProvider(NULL, $token);
            $insights = new PersonalityInsights(WatsonCredential::initWithTokenProvider($provider));
            $model = new PersonalityInsightsModel();
            $contentItemsData=\GuzzleHttp\json_decode(file_get_contents(__DIR__ . './../Tests/data/contentitems.json'),true);
            $model->setContentItems($contentItemsData);

            $result = $insights->Profile($model);

            $this->assertEquals(200, $result->getStatusCode());
        }
        catch(HttpClientException $ex) {

        }
    }

    /**
     * Request a new token
     */
    private function getToken($username, $password) {

        $serviceUrl = 'https://gateway.watsonplatform.net/personality-insights/api/v3/profile?version=2016-10-20';

        return SimpleTokenHelper::requestToken($username, $password, $serviceUrl);
    }
}
