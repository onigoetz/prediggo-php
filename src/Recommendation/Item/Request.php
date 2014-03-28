<?php namespace Prediggo\Recommendation\Item;

use Prediggo\Utils;

/**
 * Class for executing a getItemRecommendation query.
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
     * Gets an appropriate result handler for this request.
     * @return ResultHandler An appropriate result handler for this request.
     */
    protected function getResultHandler()
    {
        return new ResultHandler();
    }

    /**
     * Creates a key value array of the parameters that need to be passed by  url.
     * @return array A key value map.
     */
    protected function getArgumentMap()
    {
        $argMap = parent::getArgumentMap();

        //item infos
        $argMap["itemID"] = $this->parameter->getItemInfo()->getItemId();
        $argMap["name"] = $this->parameter->getItemInfo()->getItemName();


        $bufferKeys = "";
        $bufferValues = "";

        //implode the key values pairs into separate strings
        Utils::implodeKeyValuePairsToSeparatedString(
            $this->parameter->getItemInfo()->getAttributes(),
            "_/_",
            $bufferKeys,
            $bufferValues
        );

        //add parameters
        $argMap["itemInfoAttributeNames"] = $bufferKeys;
        $argMap["itemInfoAttributeValues"] = $bufferValues;

        return $argMap;
    }

    /**
     * Creates a result object of appropriate type for this request.
     * @return Result A GetItemRecommendationResult object.
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
        return "GetItemRecommandation_MainFrame";
    }
}
