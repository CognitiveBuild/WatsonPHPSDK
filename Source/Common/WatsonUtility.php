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

class WatsonUtility {

    /**
     * Map array to instance
     * 
     * @param $array array
     * @param $instance object
     * @return object
     */
    public static function map($array, $instance) {

        $class_name = get_class($instance);
        $reflection = new ReflectionClass($instance);

        foreach ($array as $key => $val) {
            $setter = 'set' . self::getCamelCaseName($key);
            if($reflection->hasMethod($setter)) {
                $instance->$setter($val);
            }
        }
    }

    /**
     * Removes - and _ and makes the next letter uppercase
     *
     * @param $name string
     *
     * @return string
     */
    private static function getCamelCaseName($name) {
        return str_replace(
            ' ', '', ucwords(str_replace(array('_', '-'), ' ', $name))
        );
    }
}