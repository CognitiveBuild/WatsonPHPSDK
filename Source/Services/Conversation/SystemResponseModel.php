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
 * Conversation SystemResponse model
 */
class SystemResponseModel extends ServiceModel {

    /**
     * @name(dialog_stack)
     * 
     * An array of DialogStack objects identifying the dialog nodes that are in focus in the conversation.
     * 
     * @var array
     */
    protected $_dialog_stack;

    /**
     * @name(dialog_turn_counter)
     * 
     * The number of cycles of user input and response in this conversation.
     * 
     * @var integer
     */
    protected $_dialog_turn_counter;

    /**
     * @name(dialog_request_counter)
     * 
     * The number of inputs in this conversation. 
     * This counter might be higher than the dialog_turn_counter counter when multiple inputs are needed before a response can be returned.
     * 
     * @var integer
     */
    protected $_dialog_request_counter;

    function __construct(DialogModel $dialog, $dialog_turn_counter, $dialog_request_counter) {

        $this->setDialogStack([ $dialog->getData('@name') ]);
        $this->setDialogTurnCounter($dialog_turn_counter);
        $this->setDialogRequestCounter($dialog_request_counter);
    }

    /**
     * Get array of DialogStack objects.
     * 
     * @return array
     */
    public function getDialogStack() {
        return $this->_dialog_stack;
    }

    /**
     * Set array of DialogStack objects.
     * 
     * @param $val array
     */
    public function setDialogStack($val) {
        $this->_dialog_stack = $val;
    }

    /**
     * Set array of DialogStack objects.
     * 
     * @param $val array
     */
    public function addDialogStack($val) {
        $this->_dialog_stack[] = $val;
    }

    /**
     * Get the number of cycles of user input and response.
     * 
     * @return void
     */
    public function getDialogTurnCounter() {
        return $this->_dialog_turn_counter;
    }

    /**
     * Set the number of cycles of user input and response.
     * 
     * @param $val integer
     */
    public function setDialogTurnCounter($val) {
        $this->_dialog_turn_counter = $val;
    }

    /**
     * Set number of inputs.
     * 
     * @return integer
     */
    public function getDialogRequestCounter() {
        return $this->_dialog_request_counter;
    }

    /**
     * Get number of inputs.
     * 
     * @param $val integer
     */
    public function setDialogRequestCounter($val) {
        $this->_dialog_request_counter = $val;
    }
}