<?php
/**
 * This is the model for the user
 * 
 * @author: Ezra Carter
 * 
 */
require_once "src/util/repo/BaseModel.php";

class User extends BaseModel
{
    // Note that these fields must match the order of the columns in sql
    public $user_id = "";
    public $first_name = "";
    public $last_name = "";
    public $email = "";
    
    function __construct(array $params = [])
    {
        parent::__construct($params);
    }
}
?>
