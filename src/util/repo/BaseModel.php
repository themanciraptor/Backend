<?php
/**
 * There are some elements that should be shared by all models. This class aims to consolidate them into
 * a singled easy to use class. 
 * 
 * @author: Ezra Carter
 */

 class BaseModel
 {
    protected $_created = "";
    protected $_updated = "";
    protected $_deleted = null;

    function getDeleted(): string
    {
        return $this->_deleted;
    }
    function getCreated(): string
    {
        return $this->_created;
    }
    function getUpdated(): string
    {
        return $this->_updated;
    }

    function __construct(array $params = [])
    {
        $this->_created = self::getSqlNow();
        $this->_updated = self::getSqlNow();
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
    }

    public function toRefList(): array
    {
        $scanList = [];
        $i = 0;
        foreach ($this as &$value) {
            $scanList[$i] = &$value;
            $i++;
        }
        unset($value); // Necessary to prevent unexpected results
        return $scanList;
    }

    private static function getSqlNow(): string
    {
        return date("Y-m-d H:i:s");
    }
 }
?>