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

namespace WatsonSDK\Services\Assistant;

use WatsonSDK\Common\ServiceModel;

/**
 * Assistant OutputData model
 */
class OutputDataModel extends ServiceModel {

    /**
     * @name(text)
     * 
     * An array of responses to the user. Returns an empty array if no responses are returned.
     * 
     * @var string
     */
    protected $_text;

    /**
     * @array(log_messages)
     * 
     * Up to 50 messages logged with the request. Returns an empty array if no messages are returned.
     * 
     * @var array
     */
    protected $_log_messages;

    /**
     * @array(nodes_visited)
     * 
     * An array of the nodes that were triggered to create the response. 
     * This information is useful for debugging and for visualizing the path taken through the node tree.
     * 
     * @var array
     */
    protected $_nodes_visited;

    /**
     * @name(nodes_visited_details)
     * 
     * An array of objects containing detailed diagnostic information about the nodes that were triggered during processing of the input message.
     * Included only if nodes_visited_details is set to true in the message request.
     * 
     * @var boolean
     */
    protected $_nodes_visited_details;

    /**
     * Constructor.
     * 
     * @param array $text
     * @param array $logMessages
     * @param array $nodesVisited
     */
    function __construct($text = NULL, $logMessages = NULL, $nodesVisited = NULL, $nodes_visited_details = NULL) {

        $this->setText($text);
        $this->setLogMessages($logMessages);
        $this->setNodesVisited($nodesVisited);
        $this->setNodesVisitedDetails($nodes_visited_details);

    }

    /**
     * Get the text of the user input.
     * 
     * @return array
     */
    public function getText() {
        return $this->_text;
    }

    /**
     * Set the text of the user input.
     * 
     * @param array $val
     */
    public function setText($val) {
        $this->_text = $val;
    }

    /**
     * Get messages logged.
     * 
     * @return array
     */
    public function getLogMessages() {
        return $this->_log_messages;
    }

    /**
     * Set messages logged.
     * 
     * @param array $val
     */
    public function setLogMessages($val) {
        $this->_log_messages = $val;
    }

    /**
     * Get nodes that were triggered to create the response.
     * 
     * @return array
     */
    public function getNodesVisited() {
        return $this->_nodes_visited;
    }

    /**
     * Set nodes that were triggered to create the response.
     * 
     * @param array $val
     */
    public function setNodesVisited($val) {
        $this->_nodes_visited = $val;
    }

    /**
     * Get the array of objects containing detailed diagnostic information about the nodes that were triggered during processing of the input message.
     * 
     * @return boolean
     */
    public function getNodesVisitedDetails() {
        return $this->_nodes_visited_details;
    }

    /**
     * Set the array of objects containing detailed diagnostic information about the nodes that were triggered during processing of the input message.
     * 
     * @param boolean $val
     */
    public function setNodesVisitedDetails($val) {
        $this->_nodes_visited_details = $val;
    }
}