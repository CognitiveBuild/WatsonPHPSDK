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

class PersonalityInsightsTest extends TestCase {

    protected function setUp() {

        $env = new Environment(__DIR__);
        $env->load();
    }

    /**
     * PersonalityInsightsModel unit test
     */
    public function testPersonalityInsightsModel () {

        $model = new PersonalityInsightsModel('c');

        $this->assertInstanceOf(
            PersonalityInsightsModel::class,
            $model
        );

        $model->setAcceptLanguage('al');
        $model->setAccept(TRUE);
        $model->setConsumptionPreferences(TRUE);
        $model->setContentLanguage('cl');
        $model->setCsvHeaders(TRUE);
        $model->setRawScores(TRUE);
        $model->setVersion('new-version');

        $this->assertEquals($model->getVersion(), 'new-version');
        $this->assertEquals($model->getAccept(), TRUE);
        $this->assertEquals($model->getAcceptLanguage(), 'al');
        $this->assertEquals($model->getConsumptionPreferences(), TRUE);
        $this->assertEquals($model->getContents(), [ 'text' => 'c' ]);
        $this->assertEquals($model->getContentLanguage(), 'cl');
        $this->assertEquals($model->getCsvHeaders(), TRUE);
        $this->assertEquals($model->getRawScores(), TRUE);

        $this->assertEquals($model->getData('@query'), [
            'raw_scores' => TRUE,
            'consumption_preferences' => TRUE,
            'version' => 'new-version',
            'csv_headers' => TRUE
        ]);

        $this->assertEquals($model->getData('@header'), [
            'Content-Language' => 'cl',
            'Accept-Language' => 'al',
            'Accept' => TRUE
        ]);

        $model->setContents(PersonalityInsightsModel::TYPE_CONTENT_ITEMS, 'd');
        $this->assertEquals($model->getData('@data'), [
            'contentItems' => 'd'
        ]);
    }

    /**
     * PersonalityInsights unit test with basic authentication
     */
    public function testPersonalityInsights() {

        $username = getenv('PERSONALITY_INSIGHTS_USERNAME');
        $password = getenv('PERSONALITY_INSIGHTS_PASSWORD');

        $insights = new PersonalityInsights(WatsonCredential::initWithCredentials($username, $password));
        $model    = new PersonalityInsightsModel();

        $this->assertInstanceOf(
            PersonalityInsights::class,
            $insights
        );

        $profile = json_decode(file_get_contents(__DIR__ . './../Tests/Data/PersonalityInsights.json'), true);
        $model->setContents(PersonalityInsightsModel::TYPE_CONTENT_ITEMS, $profile['contentItems']);
        $model->setRawScores(TRUE);

        if(isset($username) && isset($password)) {
            $result = $insights->Profile($model);

            $this->assertEquals(200, $result->getStatusCode());
        }
    }

    /**
     * PersonalityInsights unit test for handling error response
     */
    public function testPersonalityInsightsResponseError() {

        $insights = new PersonalityInsights(WatsonCredential::initWithCredentials('invalid-username', 'invalid-password'));
        $model = new PersonalityInsightsModel();
        $result = $insights->Profile($model);
        $this->assertEquals(401, $result->getStatusCode());
    }

}
