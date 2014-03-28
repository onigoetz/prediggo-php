<?php namespace Prediggo\Recommendation\User;

use Prediggo\Constants\RecMethod;

/**
 * Parameter class for getUserRecommendation queries.
 *
 * @package prediggo4php
 * @subpackage types
 *
 * @author Stef
 */
class Param extends \Prediggo\Type\Filtered\Param
{
    protected $recommendationMethodToUse = RecMethod::USER_PROFILE;

    /**
     * Gets the method used to compute the recommendations.
     * @return integer the method id.
     * @see RecMethodConstants
     */
    public function getRecommendationMethodToUse()
    {
        return $this->recommendationMethodToUse;
    }

    /**
     * Sets the method used to compute the recommendations.
     * @param integer $recommendationMethodToUse the method id to set
     * @see RecMethodConstants
     */
    public function setRecommendationMethodToUse($recommendationMethodToUse)
    {
        $this->recommendationMethodToUse = $recommendationMethodToUse;
    }
}
