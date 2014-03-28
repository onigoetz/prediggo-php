<?php namespace Prediggo\Request\Notify;

/**
 * Class for executing a notifyPrediggo query.
 *
 * @package prediggo4php
 * @subpackage requests
 *
 * @author Stef
 */
class Request extends \Prediggo\Type\Base\Request
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
     * Creates a key value array of the parameters that need to be passed by  url.
     * @return array A key value map.
     */
    protected function getArgumentMap()
    {
        $argMap = parent::getArgumentMap();

        //add click parameter
        $argMap["clickparameters"] = $this->parameter->getNotificationId();

        return $argMap;
    }

    /**
     * Creates a result object of appropriate type for this request.
     * @return Result A NotifyPrediggoResult object.
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
        return "StoreClickServlet_MainFrame";
    }
}
