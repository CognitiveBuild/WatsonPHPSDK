<?php
/**
 * Copyright 2018 IBM Corp. All Rights Reserved.
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

namespace WatsonSDK\Services\Assistant;

use WatsonSDK\Common\ServiceModel;

/**
 * Assistant Create Workspace model
 */
class CreateWorkspaceModel extends ServiceModel {
    
    /**
     * @name(name)
     * 
     * The name of the workspace. This string cannot contain carriage return, newline, or tab characters, and it must be no longer than 64 characters.
     *
     * @var string
     */
    protected $_name;
    protected $_description;
    protected $_language;
    protected $_intents;
    protected $_entities;
    protected $_dialog_nodes;
    protected $_counterexamples;
    protected $_metadata;
    protected $_learning_opt_out;


}