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
    private $password = "";
    public $email = "";
    public $is_admin = "";
    
    function __construct(array $params = [])
    {
        $this->user_id = uniqid("id-");
        parent::__construct($params);
    }
}
?>
