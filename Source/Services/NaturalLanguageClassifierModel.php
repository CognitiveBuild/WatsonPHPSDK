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

namespace WatsonSDK\Services;

use WatsonSDK\Common\ServiceModel;

/**
 * Natural Language Classifier entity class
 */
class NaturalLanguageClassifierModel extends ServiceModel {

    const BASE_URL = 'https://gateway.watsonplatform.net/natural-language-classifier/api/v1';

    const LANGUAGE_EN = 'en';
    const LANGUAGE_AR = 'ar';
    const LANGUAGE_FR = 'fr';
    const LANGUAGE_DE = 'de';
    const LANGUAGE_IT = 'it';
    const LANGUAGE_JA = 'ja';
    const LANGUAGE_PT = 'pt';
    const LANGUAGE_ES = 'es';

}