<?php namespace Prediggo\Request\Notify;

/**
 * Parameter class for NotifyPrediggo queries.
 *
 * @package prediggo4php
 * @subpackage types
 *
 * @author Stef
 */
class Param extends \Prediggo\Type\Base\Param
{

    protected $notificationId = "";

    /**
     * Gets the clicked recommendation identifier
     * @return string the clicked recommendation identifier
     */
    public function getNotificationId()
    {
        return $this->notificationId;
    }

    /**
     * Sets the clicked recommendation identifier.
     * @param string $notificationId the clicked recommendation identifier
     */
    public function setNotificationId($notificationId)
    {
        $this->notificationId = $notificationId;
    }
}
