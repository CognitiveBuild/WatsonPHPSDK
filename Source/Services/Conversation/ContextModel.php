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

namespace WatsonSDK\Services\Conversation;

use WatsonSDK\Common\ServiceModel;

/**
 * Conversation Context model
 */
class ContextModel extends ServiceModel {

    /**
     * @name(conversation_id)
     * 
     * The unique identifier of the conversation.
     * 
     * @var string
     */
    protected $_conversation_id;

    /**
     * @name(system)
     * 
     * A SystemResponse object that includes information about the dialog.
     * 
     * @var SystemResponseModel
     */
    protected $_system;

    /**
     * Constructor.
     * 
     * @param $conversation_id string
     * @param $system SystemResponseModel
     */
    function __construct($conversation_id = NULL, SystemResponseModel $system = NULL) {

        if(is_null($conversation_id) === FALSE) {
            $this->setConversationId($conversation_id);
        }

        if(is_null($system) === FALSE) {
            $this->setSystem($system);
        }
    }

    /**
     * Get the unique identifier of the conversation.
     * 
     * @return string
     */
    public function getConversationId() {
        return $this->_conversation_id;
    }

    /**
     * Set the unique identifier of the conversation.
     * 
     * @param $val string
     */
    public function setConversationId($val) {
        $this->_conversation_id = $val;
    }

    /**
     * Get the unique identifier of the conversation.
     * 
     * @return array
     */
    public function getSystem() {
        return $this->_system;
    }

    /**
     * Set the unique identifier of the conversation.
     * 
     * @param $val array
     */
    public function setSystem($val) {
        $this->_system = $val;
    }
}