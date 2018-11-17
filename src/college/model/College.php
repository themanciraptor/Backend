<?php
/**
 * This is the model of a College
 * 
 * @author: Ezra Carter
 * 
 */
require_once "src/util/model/BaseModel.php";

class College extends BaseModel
{
    // Note that these fields must match the order of the columns in sql
    public $college_id = "";
    public $name = "";
    public $address = "";
    
    function __construct(array $params = [])
    {
        parent::__construct($params);
    }
}
?>
