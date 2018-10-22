<?php
/**
 * There are some elements that should be shared by all repositories. This class aims to consolidate them into
 * a singled easy to use class. 
 */

 class BaseModel
 {
    protected $_created = "";
    protected $_updated = "";
    protected $_deleted = "";
    
    function __construct($created, $updated, $deleted)
    {
        $_created = $created;
        $_updated = $updated;
        $_deleted = $deleted;
    }

    function getDeleted(): string
    {
        return $deleted;
    }
    function getCreated(): string
    {
        return $deleted;
    }
    function getUpdated(): string
    {
        return $deleted;
    }
 }
?>