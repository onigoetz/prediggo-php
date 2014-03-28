<?php namespace Prediggo\Type\Base;

use DOMDocument;
use Prediggo\PrediggoException;

/**
 * This class provides a basic template for executing the three steps of a webservice query. This includes converting the API parameters to
 * the corresponding request url, executing the call and finally converting the response to a nice API object.
 *
 * @package prediggo4php
 * @subpackage requests
 *
 * @author Stef
 */
abstract class Request
{
    /**
     * @var string
     * Name and version of this library
     */
    const LIBRARY_NAME = "PHP5_V3"; //since 21/03/2011

    /**
     * @var integer
     * Name and version of the API
     */
    const API_VERSION = 3; //since 21/03/2011

    /**
     * Parameter object.
     *
     * @var Param
     */
    protected $parameter;

    /**
     * Result object.
     */
    protected $result;

    /**
     * Constructs a new request
     * @param Param $param this query parameter object
     */
    public function __construct(Param $param)
    {
        $this->parameter = $param;
    }

    /**
     * Creates a key value array of the parameters that need to be passed by  url.
     * @return array A key value map.
     */
    protected function getArgumentMap()
    {
        $argMap = array();

        $argMap["requestID"] = $this->parameter->getSessionId();
        $argMap["shopID"] = $this->parameter->getShopId();
        $argMap["sysLang"] = "XML";
        $argMap["clientLib"] = self::LIBRARY_NAME;
        $argMap["apiVersion"] = self::API_VERSION;
        $argMap["variantID"] = $this->parameter->getVariantId();

        return $argMap;
    }

    /**
     * Gets the name of the servlet which serves this kind of request on prediggo side.
     * @return string The name of the servlet
     */
    abstract protected function getServletName();

    /**
     * Creates a result object of appropriate type for this request.
     * @return mixed An inheritor of Result, exact type depends on the concrete class.
     */
    abstract protected function createResponseObject();

    /**
     * Creates the definitive url...
     * @return string The request url.
     */
    protected function createRequestUrl()
    {
        //url body
        $request = $this->parameter->getServerUrl();
        $request .= "/Servlets/" . $this->GetServletName() . "?";

        //url parameters
        foreach ($this->getArgumentMap() as $key => $value) {
            if (!empty($value)) {
                $request .= $key . "=" . urlencode($value) . "&";
            }
        }

        //suppress last "?" or "&"
        return substr($request, 0, strlen($request) - 1);
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
     * Prepares and executes the request.
     */
    public function doWebRequest()
    {
        //parse xml document
        $xmlDocument = new DOMDocument();

        if (!$xmlDocument->loadXML($this->executeWebCall())) {
            throw new PrediggoException("XML error : Malformed or incomplete document?", PrediggoException::ERR_XML);
        }

        $resultObj = $this->createResponseObject();

        //read the node into resultObj if possible
        $this->getResultHandler()->transform($xmlDocument, $resultObj);

        $this->result = $resultObj;
    }

    /**
     * Executes the web query using curl.
     *
     * @return string the downloaded document.
     * @throws PrediggoException
     */
    public function executeWebCall()
    {
        $timeout = ceil($this->parameter->getTimeout() / 1000.0);

        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_USERAGENT => "phpClientLib", // who am i
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            CURLOPT_URL => $this->createRequestUrl(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type:text/xml; charset=utf-8'
            )
        );

        //follow redirects if supported
        if (!ini_get('safe_mode') && !ini_get("open_basedir")) {
            $options[CURLOPT_FOLLOWLOCATION] = true;
        }

        $curlRequest = curl_init();
        curl_setopt_array($curlRequest, $options);

        //executes the request
        $content = curl_exec($curlRequest);

        //error retrieval
        $err = curl_errno($curlRequest);
        $errmsg = curl_error($curlRequest);
        $httpCode = curl_getinfo($curlRequest, CURLINFO_HTTP_CODE);
        curl_close($curlRequest);

        //socket error?
        if ($err != 0) {
            throw new PrediggoException("cURL error : $errmsg ($err)", PrediggoException::ERR_CURL);
        }
        //http error?
        if ($httpCode < 200 || $httpCode >= 400) {
            throw new PrediggoException("cURL error : bad HTTP status code ($httpCode)", PrediggoException::ERR_CURL);
        }

        return $content;
    }

    /**
     * Gets the parameters of this query
     * @return mixed  An inheritor of Param, exact type depends on the concrete class.
     */
    public function getParameterObject()
    {
        return $this->parameter;
    }

    /**
     * Gets the results of this query.
     * @return mixed An inheritor of Result, exact type depends on the concrete class.
     */
    public function getResultObject()
    {
        return $this->result;
    }
}
