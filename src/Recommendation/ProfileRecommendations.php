<?php namespace Prediggo\Recommendation;

/**
 * A recommendation collection with profile information.
 *
 * @package prediggo4php
 * @subpackage types
 *
 * @author Stef
 */
class ProfileRecommendations
{
    protected $recommendedItems = array();
    protected $recommendedAds = array();

    protected $profileMapId = 0;
    protected $profileName = "";

    /**
     * Gets the list of recommended items.
     * @return array an array of ItemRecommendation objects
     */
    public function getRecommendedItems()
    {
        return $this->recommendedItems;
    }

    /**
     * Adds a new recommended item in this profile. This function should not be called
     * from customer code.
     *
     * @param Item $item The item recommendation to add.
     */
    public function addRecommendedItem(Item $item)
    {
        $this->recommendedItems[] = $item;
    }

    /**
     * Gets the list of recommended ads.
     * @return array an array of Advertisement objects
     */
    public function getRecommendedAds()
    {
        return $this->recommendedAds;
    }

    /**
     * Adds a new recommended ad in this profile. This function should not be called
     * from customer code.
     *
     * @param Advertisement $ad The advertisement recommendation to add.
     */
    public function addRecommendedAd(Advertisement $ad)
    {
        $this->recommendedAds[] = $ad;
    }

    /**
     * Gets the profile name
     * @return string the profile name
     */
    public function getProfileName()
    {
        return $this->profileName;
    }

    /**
     * Sets the profile name
     * @param string $profileName the profile name to set
     */
    public function setProfileName($profileName)
    {
        $this->profileName = $profileName;
    }

    /**
     * Gets the mapped profile identifier
     * @return integer the profile identifier
     */
    public function getProfileMapId()
    {
        return $this->profileMapId;
    }

    /**
     * Sets the mapped profile identifier
     * @param integer $profileMapId the profile identifier
     */
    public function setProfileMapId($profileMapId)
    {
        $this->profileMapId = $profileMapId;
    }
}
