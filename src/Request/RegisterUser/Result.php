<?php namespace Prediggo\Request\RegisterUser;

/**
 * This class represents the result of a registerUser query.
 *
 * @package prediggo4php
 * @subpackage types
 *
 * @author Stef
 */
class Result extends \Prediggo\Type\Base\Result
{
    protected $userId;

    /**
     * Gets the user identifier that was used in the query.
     * @return string the user identifier
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Sets the user identifier that was used in the query.
     * @param string $userId the user identifier
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
