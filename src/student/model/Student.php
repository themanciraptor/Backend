<?php
/**
 * This is the model for the user
 * 
 * @author: Ezra Carter
 * 
 */
require_once "src/util/repo/BaseModel.php";

class Student extends BaseModel
{
    // Note that these fields must match the order of the columns in sql
    public $student_id = "";
    public $user_id = "";
    public $fisrt_name = "";
    public $last_name = "";
    public $email = false;
    public $address = "";
    
    function __construct(array $params = [])
    {
        $this->student_id = uniqid();
        parent::__construct($params);
    }
}
?>
