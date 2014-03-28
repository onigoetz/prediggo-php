<?php namespace Prediggo\Recommendation\Item;

use DOMNode;
use \Prediggo\Recommendation\Bundle;

/**
 * Result handler for GetItemRecommendation queries.
 *
 * @package prediggo4php
 * @subpackage xmlhandlers
 *
 * @author Stef
 */
class ResultHandler extends \Prediggo\Type\Recommendation\ResultHandler
{
    /**
     * Handles the current node in the xml reading loop.
     * @param DOMNode $node The current xml node
     * @param Result $resultObj The object which will be returned to the end-user
     * @return boolean True if the node was handled
     */
    protected function handleXmlReaderCurrentNode(DOMNode $node, $resultObj)
    {
        if (parent::handleXmlReaderCurrentNode($node, $resultObj)) {
            return true;
        }

        switch ($node->nodeName) {
            case "item":
                $resultObj->setItemId($node->textContent);
                return true;
            case "bundles":
                //bundles list
                foreach ($node->childNodes as $itemNode) {
                    if ($itemNode->nodeName == "item") {
                        $item = new Bundle();
                        $this->readItem($itemNode, $item);

                        $resultObj->addRecommendedBundles($item);
                    }
                }
                return true;

        }

        return false;
    }
}
