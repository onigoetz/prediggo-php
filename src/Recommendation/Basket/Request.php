<?php namespace Prediggo\Recommendation\Basket;

use Prediggo\Utils;

/**
 * Class for executing getBasketRecommendation queries.
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

        $bufferKeys = "";
        $bufferValues = "";

        //implode the key values pairs into separate strings
        Utils::implodeKeyValuePairsToSeparatedString(
            $this->parameter->getBasketItems(),
            "_/_",
            $bufferKeys,
            $bufferValues
        );

        //add parameters
        $argMap["classIDs"] = $bufferKeys;
        $argMap["itemIDs"] = $bufferValues;

        return $argMap;
    }

    /**
     * {@inheritdoc}
     */
    protected function getServletName()
    {
        return "GetBasketRecommendations_MainFrame";
    }

    /**
     * {@inheritdoc}
     */
    protected function createResponseObject()
    {
        return new Result();
    }
}
