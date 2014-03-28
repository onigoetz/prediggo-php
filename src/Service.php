<?php namespace Prediggo;

/**
 * Service interface for querying the prediggo server....
 *
 * @package prediggo4php
 *
 * @author Stef
 */
class Service
{

    /**
     * An errorCode => errorMessage associative array.
     */
    private static $returnCodesAndMessages = array(
        100 => 'WARNING - results where computed using best sellers',
        2 => 'OK - no results found',
        1 => 'OK - results found',
        0 => 'OK - this is for a query that does not return results',
        -2 => 'ERROR - the platform is not available',
        -20 => 'ERROR - the customer has been idle for too long',
        -9 => 'ERROR - the shop id is null',
        -10 => 'ERROR - a parameter is null',
        -11 => 'ERROR - the identification of the shop has failed ⇒ shopID is incorrect',
        -12 => 'ERROR - the user identification has failed',
        -13 => 'ERROR - call to a web request not implemented',
        -14 => 'ERROR - No platform was found for the classID provided',
        -15 => 'ERROR - the parameter size is incorrect',
        -16 => 'ERROR - no platform found based on the shop id that we have received',
        -20 => 'ERROR - the click information has expired',
        -50 => 'ERROR - the module is not found',
        -51 => 'ERROR - the module is deactivated',
        -101 => 'ERROR - cannot load the user profile',
        -102 => 'ERROR - No ontologies found',
        -103 => 'ERROR - error while loading data in the ontology',
        -104 => 'ERROR - error while updating the status of the products',
        -105 => 'ERROR - the job for API import process is invalid',
        -106 => 'ERROR - the token id is invalid',
        -200 => 'ERROR - unknown error ⇒ Prediggo raised an exception',
    );

    /**
     * Returns the error message for a given status code.
     * @param integer $returnCode the status code
     * @return string the error message corresponding to the status code or 'No message found'.
     */
    public static function getStatusMessageForStatusCode($returnCode)
    {
        if (array_key_exists($returnCode, self::$returnCodesAndMessages)) {
            return self::$returnCodesAndMessages[$returnCode];
        } else {
            return 'No message found';
        }
    }

    /**
     * Executes a getItemRecommendation query.
     * @param Recommendation\Item\Param $param An object containing all the necessary parameters for this query
     * @return Recommendation\Item\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getItemRecommendation(Recommendation\Item\Param $param)
    {
        $request = new Recommendation\Item\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getTopNSales query.
     * @param TopNSales\Param $param An object containing all the necessary parameters for this query
     * @return TopNSales\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getTopNSales(TopNSales\Param $param)
    {
        $request = new TopNSales\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getTopNViewed query.
     * @param TopNViewed\Param $param An object containing all the necessary parameters for this query
     * @return TopNViewed\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getTopNViewed(TopNViewed\Param $param)
    {
        $request = new TopNViewed\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getBasketRecommendation query.
     * @param Recommendation\Basket\Param $param An object containing all the necessary parameters for this query
     * @return Recommendation\Basket\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getBasketRecommendation(Recommendation\Basket\Param $param)
    {
        $request = new Recommendation\Basket\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getCategoryRecommendation query.
     * @param Recommendation\Category\Param $param An object containing all the necessary parameters for this query
     * @return Recommendation\Category\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getCategoryRecommendation(Recommendation\Category\Param $param)
    {
        $request = new Recommendation\Category\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getLandingPageRecommendation query.
     * @param Recommendation\LandingPage\Param $param An object containing all the necessary parameters for this query
     * @return Recommendation\LandingPage\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getLandingPageRecommendation(Recommendation\LandingPage\Param $param)
    {
        $request = new Recommendation\LandingPage\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getSearchPageRecommendation query.
     * @param Recommendation\SearchPage\Param $param An object containing all the necessary parameters for this query
     * @return Recommendation\SearchPage\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getSearchPageRecommendation(Recommendation\SearchPage\Param $param)
    {
        $request = new Recommendation\SearchPage\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getUserRecommendation query.
     * @param Recommendation\User\Param $param An object containing all the necessary parameters for this query
     * @return Recommendation\User\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getUserRecommendation(Recommendation\User\Param $param)
    {
        $request = new Recommendation\User\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a registerUser query.
     * @param Request\RegisterUser\Param $param An object containing all the necessary parameters for this query
     * @return Request\RegisterUser\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function registerUser(Request\RegisterUser\Param $param)
    {
        $request = new Request\RegisterUser\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a setCategory query.
     * @param Request\SetCategory\Param $param An object containing all the necessary parameters for this query
     * @return Request\SetCategory\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function setCategory(Request\SetCategory\Param $param)
    {
        $request = new Request\SetCategory\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a notifyPrediggo query.
     * @param Request\Notify\Param $param An object containing all the necessary parameters for this query
     * @return Request\Notify\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function notifyPrediggo(Request\Notify\Param $param)
    {
        $request = new Request\Notify\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Execute an autoComplete query.
     * Please refer to the documentation for a complete description of use cases and parameters.
     * @param Request\AutoComplete\Param $param An object containing all the necessary parameters for this query.
     * @return Request\AutoComplete\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function autoComplete(Request\AutoComplete\Param $param)
    {
        $request = new Request\AutoComplete\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a getAdvertisement query.
     * @param Request\Advertisement\Param $param An object containing all the necessary parameters for this query
     * @return Request\Advertisement\Result An object containing the results.
     * @throws PrediggoException in case of errors
     */
    public static function getAdvertisement(Request\Advertisement\Param $param)
    {
        $request = new Request\Advertisement\Request($param);

        self::executeCall($request);
        return $request->getResultObject();
    }

    /**
     * Executes a servlet call.
     * @param Type\Base\Request $request the request to execute.
     */
    private static function executeCall(Type\Base\Request $request)
    {
        //execute request
        $request->doWebRequest();

        //check response status
        self::checkStatus($request->getResultObject());
    }

    /**
     * Checks the result code of a query.
     * @param Type\Base\Result $result the result object to test
     * @throws PrediggoException in case the result contains an error.
     */
    private static function checkStatus(Type\Base\Result $result)
    {
        $result->setStatusMessage(self::getStatusMessageForStatusCode($result->getStatus()));

        //error returned?
        if ($result->getStatus() < 0) {
            throw new PrediggoException("{$result->getStatusMessage()} ({$result->getStatus()})");
        }
    }
}
