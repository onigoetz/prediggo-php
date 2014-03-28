<?php namespace Prediggo\Type\Recommendation;

use Prediggo\Recommendation\ProfileRecommendations;

/**
 * Base class of all recommendation requests results.
 *
 * @package prediggo4php
 * @subpackage types
 *
 * @author Stef
 */
class Result extends \Prediggo\Type\Base\Result
{
    protected $recommendationProfiles = array();

    /**
     * Gets the list of recommended items.
     * @return array an array of Recommendation\Item objects
     */
    public function getRecommendedItems()
    {
        $reco = array();

        foreach ($this->recommendationProfiles as $profile) {
            $reco = array_merge($reco, $profile->getRecommendedItems());
        }

        return $reco;
    }

    /**
     * Gets the list of recommended ads.
     * @return array an array of Advertisement objects
     */
    public function getRecommendedAds()
    {
        $reco = array();

        foreach ($this->recommendationProfiles as $profile) {
            $reco = array_merge($reco, $profile->getRecommendedAds());
        }

        return $reco;
    }

    /**
     * Gets a list of recommendation profiles returned by the query, they contain profile information as well as recommendations.
     * @return array A list of recommendation profiles
     */
    public function getRecommendationProfiles()
    {
        return $this->recommendationProfiles;
    }

    /**
     * Adds a new set of recommendations to this result object. This function should not be called
     * from customer code.
     *
     * @param ProfileRecommendations $profile The set of recommendation to add.
     */
    public function addRecommendationProfile(ProfileRecommendations $profile)
    {
        $this->recommendationProfiles[] = $profile;
    }
}
