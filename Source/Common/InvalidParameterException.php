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

/**
 * Custom InvalidParameterException inheriting the properties and methods:
 * 
 * protected string $message ;
 * protected int $code ;
 * protected string $file ;
 * protected int $line ;
 * 
 * public __construct ([ string $message = "" [, int $code = 0 [, Exception $previous = NULL ]]] )
 * final public string getMessage ( void )
 * final public Exception getPrevious ( void )
 * final public int getCode ( void )
 * final public string getFile ( void )
 * final public int getLine ( void )
 * final public array getTrace ( void )
 * final public string getTraceAsString ( void )
 * public string __toString ( void )
 *
 */

namespace WatsonSDK\Common;

class InvalidParameterException extends \Exception {
    
}