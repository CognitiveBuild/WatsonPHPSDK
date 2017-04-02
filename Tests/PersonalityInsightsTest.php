<?php
/**
 * Copyright 2017 IBM Corp. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace WatsonSDK\Tests;

use WatsonSDK\Common\HttpClient;
use WatsonSDK\Common\HttpClientConfiguration;
use WatsonSDK\Common\HttpClientException;
use WatsonSDK\Common\SimpleTokenProvider;
use WatsonSDK\Common\SimpleTokenHelper;
use WatsonSDK\Common\WatsonCredential;
use WatsonSDK\Common\InvalidParameterException;

use WatsonSDK\Services\PersonalityInsights;
use WatsonSDK\Services\PersonalityInsights\ProfileModel;
use WatsonSDK\Services\PersonalityInsights\ContentItemModel;

class PersonalityInsightsTest extends BaseTestCase {

    /**
     * ProfileModel unit test
     */
    public function testProfileModel () {

        $model = new ProfileModel( new ContentItemModel('c') );

        $this->assertInstanceOf(
            ProfileModel::class,
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
        $this->assertEquals($model->getContents(), [ 'contentItems' => [ [ 'content' => 'c' ] ]] );
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

        $model->setContents( [ [ 'content' => 'd', 'contenttype' => 'text/plain' ] ] );
        $this->assertEquals($model->getContents(), [ 'contentItems' => [ [ 'content' => 'd', 'contenttype' => 'text/plain' ] ] ]);
    }


    /**
     * ContentItemsModel unit test
     */
    public function testContentItemsModel() {

        $model = new ContentItemModel('item');

        $this->assertInstanceOf(
            ContentItemModel::class,
            $model
        );

        $model->setContent('c');
        $model->setContentType('t');
        $model->setCreated(1);
        $model->setUpdated(1);
        $model->setForward(TRUE);
        $model->setId('id');
        $model->setLanguage('en');
        $model->setParentId('pid');
        $model->setReply(TRUE);

        $this->assertEquals($model->getContent(),'c');
        $this->assertEquals($model->getContentType(),'t');
        $this->assertEquals($model->getCreated(),1);
        $this->assertEquals($model->getUpdated(),1);
        $this->assertEquals($model->getForward(),TRUE);
        $this->assertEquals($model->getId(),'id');
        $this->assertEquals($model->getLanguage(),'en');
        $this->assertEquals($model->getParentId(),'pid');
        $this->assertEquals($model->getReply(),TRUE);
        $this->assertEquals($model->getData('@name'), [ 'content' => 'c', 'id'=>'id', 'contenttype' => 't', 'created' => 1, 'updated' => 1,'forward' => TRUE, 'language' => 'en', 'parentid' => 'pid', 'reply' => TRUE ]);
    }

    /**
     * PersonalityInsights unit test with basic authentication
     */
    public function testPersonalityInsightsWithText() {

        $username = getenv('PERSONALITY_INSIGHTS_USERNAME');
        $password = getenv('PERSONALITY_INSIGHTS_PASSWORD');

        $insights = new PersonalityInsights(WatsonCredential::initWithCredentials($username, $password));

        if(isset($username) && isset($password)) {
            $text = file_get_contents('http://php-sdk.migg.cn/data/PersonalityInsights.text');
            $result = $insights->getProfile($text);
            $this->assertEquals(200, $result->getStatusCode());
        }
    }

    /**
     * PersonalityInsights unit test with basic authentication
     */
    public function testPersonalityInsightsWithModel() {

        $username = getenv('PERSONALITY_INSIGHTS_USERNAME');
        $password = getenv('PERSONALITY_INSIGHTS_PASSWORD');

        $insights = new PersonalityInsights(WatsonCredential::initWithCredentials($username, $password));
        $model    = new ProfileModel(new ContentItemModel(' The IBM Watson™ Personality Insights service enables applications to derive insights from social media, enterprise data, or other digital communications. The service uses linguistic analytics to infer individuals\' intrinsic personality characteristics, including Big Five, Needs, and Values, from digital communications such as email, text messages, tweets, and forum posts. '));

        $model->addContent(new ContentItemModel(' The service can automatically infer, from potentially noisy social media, portraits of individuals that reflect their personality characteristics. The service can infer consumption preferences based on the results of its analysis and, for JSON content that is timestamped, can report temporal behavior. '));
        $model->addContent(new ContentItemModel(' For information about the meaning of the models that the service uses to describe personality characteristics, see Personality models. For information about the meaning of the consumption preferences, see Consumption preferences. '));
        $model->addContent(new ContentItemModel(' Note: You can continue to use the previous version of the Personality Insights API (v2) until January 31, 2017. You can access reference documentation for the v2 API at API reference for v2. You can also access the interactive tool for testing calls to the v2 API and viewing live responses from the service at API explorer for v2. '));
        $model->addContent(new ContentItemModel(' You authenticate to the Personality Insights API by providing the username and password that are provided in the service credentials for the service instance that you want to use. The API uses HTTP basic authentication. '));
        $model->addContent(new ContentItemModel(' After creating an instance of the Personality Insights service, select Service Credentials from the navigation on the left side of its dashboard page to see the username and password that are associated with the instance. For more information, see Obtaining credentials for Watson services. '));
        $model->addContent(new ContentItemModel(' Applications can also use tokens to establish authenticated communications with Watson services without embedding their service credentials in every call. You write an authentication proxy in Bluemix to obtain a token for your client application, which can then use the token to call the service directly. You use your service credentials to obtain a token for that service. For more information, see Using tokens with Watson services. '));
        $model->addContent(new ContentItemModel(' By default, Bluemix collects data from all requests and uses the data to improve the Watson services. If you do not want to share your data, you can disable request logging by setting the X-Watson-Learning-Opt-Out header to true for each request. Data is not collected for any request that includes this header. For more information, see Controlling request logging for Watson services. '));
        $model->addContent(new ContentItemModel(' The Personality Insights service uses standard HTTP response codes to indicate whether a method completed successfully. A 200-level response always indicates success. A 400-level response indicates some sort of failure. And a 500-level response typically indicates an internal system error. '));
        $model->addContent(new ContentItemModel(' Generates a personality profile for the author of the input text. The service accepts a maximum of 20 MB of input content. It can analyze text in Arabic, English, Japanese, or Spanish and return its results in a variety of languages. You can provide plain text, HTML, or JSON input. The service returns output in JSON format by default, but you can request the output in CSV format. '));
        $model->addContent(new ContentItemModel(' Visual Recognition understands the contents of images - visual concepts tag the image, find human faces, approximate age and gender, and find similar images in a collection. You can also train the service by creating your own custom concepts. Use Visual Recognition to detect a dress type in retail, identify spoiled fruit in inventory, and more. '));
        $model->addContent(new ContentItemModel(' The IBM Watson™ Visual Recognition service uses deep learning algorithms to analyze images for scenes, objects, faces, and other content. The response includes keywords that provide information about the content. '));
        $model->addContent(new ContentItemModel(' A set of built-in classes provides highly accurate results without training. You can train custom classifiers to create specialized classes. You can also create custom collections of your own images, and then upload an image to search the collection for similar images. '));

        $item = new ContentItemModel("this is a test for contentItem Model");
        $model->addContent($item);

        $this->assertInstanceOf(
            PersonalityInsights::class,
            $insights
        );

        $model->setConsumptionPreferences(TRUE);

        if(isset($username) && isset($password)) {
            $result = $insights->getProfile($model);
            $this->assertEquals(200, $result->getStatusCode());
        }
    }

    /**
     * PersonalityInsights unit test with basic authentication
     */
    public function testPersonalityInsightsWithJSONProfile() {

        $username = getenv('PERSONALITY_INSIGHTS_USERNAME');
        $password = getenv('PERSONALITY_INSIGHTS_PASSWORD');

        $insights = new PersonalityInsights(WatsonCredential::initWithCredentials($username, $password));
        $model    = new ProfileModel('This sentence will not be included.');

        $this->assertInstanceOf(
            PersonalityInsights::class,
            $insights
        );

        $profile = json_decode(file_get_contents('http://php-sdk.migg.cn/data/PersonalityInsights.json'), TRUE);

        $model->setContents($profile['contentItems']);
        $model->setRawScores(TRUE);

        if(isset($username) && isset($password)) {
            $result = $insights->getProfile($model);
            $this->assertEquals(200, $result->getStatusCode());
        }
    }

    /**
     * PersonalityInsights unit test for handling error response
     */
    public function testPersonalityInsightsResponseError() {

        $insights = new PersonalityInsights(WatsonCredential::initWithCredentials('invalid-username', 'invalid-password'));
        $model = new ProfileModel(new ContentItemModel('c'));
        $result = $insights->getProfile($model);
        $this->assertEquals(401, $result->getStatusCode());
    }

    /**
     * PersonalityInsights unit test for raising InvalidParameterException
     */
    public function testPersonalityInsightsInvalidParameterException() {

        $this->expectException(InvalidParameterException::class);
        $insights = new PersonalityInsights(WatsonCredential::initWithCredentials('invalid-username', 'invalid-password'));
        $result = $insights->getProfile(0);
    }
}
