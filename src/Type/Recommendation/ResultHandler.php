<?php namespace Prediggo\Type\Recommendation;

use DOMNode;
use \Prediggo\Recommendation\Item;
use \Prediggo\Recommendation\Advertisement;
use Prediggo\Recommendation\ProfileRecommendations;

/**
 * Basic result handler for all GetXXXRecommendation queries.
 *
 * @package prediggo4php
 * @subpackage xmlhandlers
 *
 * @author Stef
 */
class ResultHandler extends \Prediggo\Type\Base\ResultHandler
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
            //items list
            case "profileresult":
                $this->readProfileResult($node, $resultObj);
                return true;
        }

        return false;
    }


    /**
     * Read and parse a profileResult
     * @param DOMNode $profileNode the profileResult node
     * @param Result $resultObj the object to fill
     */
    protected function readProfileResult(DOMNode $profileNode, Result $resultObj)
    {
        //profile
        $recoProfile = new ProfileRecommendations();

        //read profile attributes
        foreach ($profileNode->attributes as $attribute) {
            switch ($attribute->name) {
                case "classID":
                    $recoProfile->setProfileMapId(intval($attribute->value));
                    break;
                case "profileName":
                    $recoProfile->setProfileName($attribute->value);
                    break;
            }
        }

        //read recommendations blocks
        foreach ($profileNode->childNodes as $recBlockNode) {
            switch ($recBlockNode->nodeName) {
                case "simplerec":
                    //items list
                    foreach ($recBlockNode->childNodes as $itemNode) {
                        if ($itemNode->nodeName == "item") {
                            $item = new Item();
                            $this->readItem($itemNode, $item);

                            $recoProfile->addRecommendedItem($item);
                        }
                    }
                    break;
                case "ads":
                    //ads list
                    foreach ($recBlockNode->childNodes as $adNode) {
                        if ($adNode->nodeName == "ad") {
                            $ad = new Advertisement();
                            $this->readAdvertisement($adNode, $ad);

                            $recoProfile->addRecommendedAd($ad);
                        }
                    }
                    break;
            }
        }

        $resultObj->addRecommendationProfile($recoProfile);
    }


    /**
     * Reads an item element.
     * @param DOMNode $itemNode an xml element representing an item
     * @param Item $item the item object to fill.
     */
    protected function readItem(DOMNode $itemNode, Item $item)
    {
        //read content
        $item->setItemId($itemNode->textContent);

        //read attributes
        foreach ($itemNode->attributes as $attribute) {

            switch ($attribute->name) {
                case "dimension":
                    $item->setDimension($attribute->value);
                    break;
                case "name":
                    $item->setItemName($attribute->value);
                    break;
                case "inferredfrom":
                    $item->setInferredFrom($attribute->value);
                    break;
                case "clickparameters":
                    $item->setNotificationId($attribute->value);
                    break;
                default:
                    $item->setAdditionalAttribute($attribute->name, $attribute->value);
                    break;
            }
        }
    }


    /**
     * Reads an "ad" (advertisement) element.
     * @param DOMNode $adNode an xml element representing an ad.
     * @param Advertisement $item the advertisement object to fill
     */
    protected function readAdvertisement(DOMNode $adNode, Advertisement $item)
    {
        //read content
        $item->setAdName($adNode->textContent);

        //read all attributes
        foreach ($adNode->attributes as $attribute) {

            switch ($attribute->name) {
                case "thumbnailurl":
                    $item->setImageUrl($attribute->value);
                    break;
                case "trailerurl":
                    $item->setTrailerUrl($attribute->value);
                    break;
                case "posterurl":
                    $item->setPosterUrl($attribute->value);
                    break;
                case "id":
                    $item->setId($attribute->value);
                    break;
                case "type":
                    $item->setAdTypeText($attribute->value);
                    break;
                case "siteurl":
                    $item->setWebsiteUrl($attribute->value);
                    break;
                case "format":
                    $item->setFormat($attribute->value);
                    break;
            }
        }
    }
}
