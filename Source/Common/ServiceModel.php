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

namespace WatsonSDK\Common;

use \ReflectionClass;

/**
 * Base class of model
 */
class ServiceModel {

    /**
     * @query(version)
     * 
     * When we make breaking changes to the API, we release a new, dated version.
     * The value for the version parameter is the date for the version of the API that you want to call.
     * The current version is 2016-05-19, and the documentation reflects the current version.
     */
    protected $_version;

    /**
     * Generate properties with data using annotations
     * 
     * @return array | NULL
     */
    final public function getData($type = '@query', $nullable_data = FALSE, $nullable_attribute = FALSE) {

        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();
        $queries = [];

        foreach($properties as $attribute) {
            $attribute->setAccessible(true);
            $docComment = $attribute->getDocComment();
            $value = $attribute->getValue($this);

            if(is_null($value) && $nullable_attribute === FALSE) {
                continue;
            }

            $matches = [];
            $match = preg_match("/{$type}(.*?)\n/", $docComment, $matches);

            if($match) {
                $key = $attribute->getName();
                if(count($matches) > 1) {
                    $name = trim($matches[1]);
                    $name = preg_replace('/[<>()\[\]{}#\* ]/', '', $name);
                    if($name !== '') {
                        if($name === '=' && is_array($value)) {
                            $key = key($value);
                            $value = $value[$key];
                        }
                        else {
                            $key = $name;
                        }
                    }
                }
                if($value instanceof ServiceModel) {
                    $queries[$key] = $value->getData($type, $nullable_data, $nullable_attribute);
                }
                else {
                    $queries[$key] = $value;
                }
            }
        }

        if($nullable_data && count($queries) === 0) {
            return NULL;
        }
        return $queries;
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
     * @param $val string
     */
    public function setVersion($val) {
        $this->_version = $val;
    }

}