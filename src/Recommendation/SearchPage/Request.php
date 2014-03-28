<?php namespace Prediggo\Recommendation\SearchPage;

/**
 * Class for executing a getSearchPageRecommendation query.
 *
 * @package prediggo4php
 * @subpackage requests
 *
 * @author Stef
 */
class Request extends \Prediggo\Type\Filtered\Request
{
    /**
     * Parameter object.
     *
     * @var Param
     */
    protected $parameter;

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
    protected function getArgumentMap()
    {
        $argMap = parent::getArgumentMap();

        //add user id...
        $argMap["queryString"] = $this->parameter->getSearchString();
        $argMap["searchRefiningOptions"] = $this->parameter->getSearchRefiningOption();

        return $argMap;
    }

    /**
     * {@inheritdoc}
     */
    protected function getServletName()
    {
        return "GetSearchPageRecommendations_MainFrame";
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
