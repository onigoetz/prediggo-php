<?php namespace Prediggo\Recommendation\LandingPage;

use Prediggo\Type\Search\ResultHandler;

/**
 * Class for executing a getLandingPageRecommendation query.
 *
 * @package prediggo4php
 * @subpackage requests
 *
 * @author Stef
 */
class Request extends \Prediggo\Type\Filtered\Request
{
    /**
     * Constructs a new request
     * @param Param $param this query parameter object
     */
    public function __construct(Param $param)
    {
        parent::__construct($param);
    }

    /**
     * {@inheritdoc}
     */
    protected function getServletName()
    {
        return "GetLandingPageRecommendations_MainFrame";
    }

    /**
     * Gets an appropriate result handler for this request.
     * @return ResultHandler An appropriate result handler for this request.
     */
    protected function getResultHandler()
    {
        return new ResultHandler();
    }

    /**
     * {@inheritdoc}
     */
    protected function createResponseObject()
    {
        return new Result();
    }
}
