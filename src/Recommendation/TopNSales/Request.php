<?php namespace Prediggo\TopNSales;

/**
 * Class for executing a getTopNSales query.
 *
 * @package prediggo4php
 * @subpackage requests
 *
 * @author Stef
 */
class Request extends \Prediggo\Type\Filtered\Request
{

    /**
     ** Constructs a new request
     * @param Param $param this query parameter object
     */
    public function __construct(Param $param)
    {
        parent::__construct($param);
    }

    /**
     * Creates a result object of appropriate type for this request.
     * @return Result A GetTopNSalesResult object.
     */
    protected function createResponseObject()
    {
        return new Result();
    }

    /**
     * Gets the name of the servlet which serves this kind of request on prediggo side.
     * @return string The name of the servlet
     */
    protected function getServletName()
    {
        return "GetTopNSalesServlet_MainFrame";
    }
}
