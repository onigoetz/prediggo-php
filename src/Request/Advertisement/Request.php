<?php namespace Prediggo\Request\Advertisement;

use Prediggo\Type\Recommendation\ResultHandler;

/**
 * GetAdvertisement request handler
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
     * Creates a key value array of the parameters that need to be passed by url.
     * @return array A key value map.
     */
    protected function getArgumentMap()
    {
        $argMap = parent::getArgumentMap();

        //parameters
        $argMap["languageCode"] = $this->parameter->getLanguageCode();
        $argMap["classID"] = $this->parameter->getProfileMapId();

        return $argMap;
    }

    /**
     * Creates a result object of appropriate type for this request.
     * @return Result A result object.
     */
    protected function createResponseObject()
    {
        return new Result();
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
     * Gets the name of the servlet which serves this kind of request on prediggo side.
     * @return string The name of the servlet
     */
    protected function getServletName()
    {
        return "GetAdsRecommandation_MainFrame";
    }
}
