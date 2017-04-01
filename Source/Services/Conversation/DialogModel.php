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
 * Conversation DialogStack model
 */
class DialogModel extends ServiceModel {

    /**
     * @name(dialog_node)
     * 
     * The ID of a dialog node.
     * 
     * @var string
     */
    protected $_dialog_node;

    /**
     * Constructor.
     * 
     * @param $dialog_node string
     */
    function __construct($dialog_node) {

        $this->setDialogNode($dialog_node);
    }

    /**
     * Get the ID of a dialog node.
     * 
     * @return string
     */
    public function getDialogNode() {
        return $this->_dialog_node;
    }

    /**
     * Set the ID of a dialog node.
     * 
     * @param $val string
     */
    public function setDialogNode($val) {
        $this->_dialog_node = $val;
    }
}