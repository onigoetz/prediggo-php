<?php namespace Prediggo\Recommendation\Basket;

use Prediggo\Utils;

/**
 * Parameter class for getBasketRecommendation queries
 *
 * @package prediggo4php
 * @subpackage types
 *
 * @author Stef
 */
class Param extends \Prediggo\Type\Filtered\Param
{
    protected $basketItems = array();

    /**
     * Gets the list of items. Items are made of Key/Value pairs representing the profile identifier followed by the item ID.
     * @return array An array of pairs representing items (int and string)
     */
    public function getBasketItems()
    {
        return $this->basketItems;
    }

    /**
     * Adds an item to the list.
     * @param integer $profileMapId The profile identifier of this item
     * @param string $itemId The item identifier
     */
    public function addBasketItem($profileMapId, $itemId)
    {
        Utils::addPairToUniqueArray($this->basketItems, $profileMapId, $itemId);
    }
}
