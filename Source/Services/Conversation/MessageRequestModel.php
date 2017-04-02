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
 * Conversation `send request` model
 */
class MessageRequestModel extends ServiceModel {

    /**
     * @data(input)
     * 
     * The user input.
     * 
     * @var array
     */
    protected $_input;

    /**
     * @data(alternate_intents)
     * 
     * Whether to return more than one intent. 
     * Set to true to return all matching intents. 
     * For example, return all intents when the confidence is not high to allow users to choose their intent. 
     * The default value is false. 
     * 
     * @var boolean
     */
    protected $_alternate_intents;

    /**
     * @data(context)
     * 
     * State information for the conversation. 
     * To maintain state, include the Context object from the previous response when sending multiple requests for the same conversation. 
     * 
     * @var ContextModel[]
     */
    protected $_context;

    /**
     * @data(entities)
     * 
     * Entities to use when evaluating the message. 
     * Include entities from the previous response to continue using those entities rather than detecting entities in the new input. 
     * 
     * @var EntityModel[]
     */
    protected $_entities;

    /**
     * @data(intents)
     * 
     * Intents to use when evaluating the user input. 
     * Include the intents from the previous response to continue using those intents rather than trying to recognize intents in the new input. 
     * 
     * @var IntentModel[]
     */
    protected $_intents;

    /**
     * @data(output)
     * 
     * System output. 
     * Include the output from the previous response to maintain intermediate informationif you have several requests within the same dialog turn. 
     * 
     * @var OutputDataModel[]
     */
    protected $_output;

    /**
     * Constructor.
     * 
     * @param $text string
     * @param $alternate_intents boolean | NULL
     * @param $context ContextModel | NULL
     * @param $entities EntityModel | NULL
     * @param $intents RuntimeIntent | NULL
     * @param $output OutputDataModel | NULL
     */
    function __construct($text, $alternate_intents = NULL, ContextModel $context = NULL, EntityModel $entities = NULL, IntentModel $intents = NULL, OutputDataModel $output = NULL) {

        $input = new InputDataModel($text);

        $this->setInput($input->getData('@name'));

        $this->setAlternateIntents($alternate_intents);

        if(is_null($context) === FALSE) {
            $this->setContext($context->getData('@name', TRUE));
        }

        if(is_null($entities) === FALSE) {
            $this->setEntities($entities->getData('@name', TRUE));
        }

        if(is_null($intents) === FALSE) {
            $this->setIntents($intents->getData('@name', TRUE));
        }

        if(is_null($output) === FALSE) {
            $this->setOutput($output->getData('@name', TRUE));
        }
    }

    /**
     * Get user input.
     * 
     * @return InputDataModel
     */
    public function getInput() {
        return $this->_input;
    }

    /**
     * Set user input.
     * 
     * @param $val InputDataModel
     */
    public function setInput($val) {
        $this->_input = $val;
    }

    /**
     * Get the value of that whether to return more than one intent.
     * 
     * @return boolean
     */
    public function getAlternateIntents() {
        return $this->_alternate_intents;
    }

    /**
     * Set the value to indicate that whether to return more than one intent.
     * 
     * @param $val boolean
     */
    public function setAlternateIntents($val) {
        $this->_alternate_intents = $val;
    }

    /**
     * Set state information for the conversation
     * 
     * @return array
     */
    public function getContext() {
        return $this->_context;
    }

    /**
     * Set state information for the conversation
     * 
     * @param $val array
     */
    public function setContext($val) {
        $this->_context = $val;
    }

    /**
     * Get entities to use when evaluating the message.
     * 
     * @return array
     */
    public function getEntities() {
        return $this->_entities;
    }

    /**
     * Set entities to use when evaluating the message.
     * 
     * @param $val array
     */
    public function setEntities($val) {
        $this->_entities = $val;
    }

    /**
     * Get intents to use when evaluating the user input.
     * 
     * @return array
     */
    public function getIntents() {
        return $this->_intents;
    }

    /**
     * Set intents to use when evaluating the user input.
     * 
     * @param $val array
     */
    public function setIntents($val) {
        $this->_intents = $val;
    }

    /**
     * Get system output.
     * 
     * @return array
     */
    public function getOutput() {
        return $this->_output;
    }

    /**
     * Set system output.
     * 
     * @param $val array
     */
    public function setOutput($val) {
        $this->_output = $val;
    }

}