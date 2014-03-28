<?php namespace Prediggo\Recommendation\Category;

/**
 * Class for executing a getCategoryRecommendation query.
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
        return "GetCategoryRecommendations_MainFrame";
    }

    /**
     * {@inheritdoc}
     */
    protected function createResponseObject()
    {
        return new Result();
    }
}
