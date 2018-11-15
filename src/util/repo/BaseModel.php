<?php
/**
 * There are some elements that should be shared by all models. This class aims to consolidate them into
 * a singled easy to use class. 
 * 
 * @author: Ezra Carter
 */
require_once "src/util/sql/Util.php";

 class BaseModel
 {
    protected $_created = "";
    protected $_modified = "";
    protected $_deleted = null;

    function getDeleted(): string
    {
        return $this->_deleted;
    }
    function getCreated(): string
    {
        return $this->_created;
    }
    function getModified(): string
    {
        return $this->_modified;
    }

    function __construct(array $params = [])
    {
        $this->_created = getSqlNow();
        $this->_modified = getSqlNow();
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
 }
?>
