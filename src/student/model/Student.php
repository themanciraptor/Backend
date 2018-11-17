<?php
/**
 * This is the model for the Student
 * 
 * @author: Ezra Carter
 * 
 */
require_once "src/util/model/BaseModel.php";

class Student extends BaseModel
{
    // Note that these fields must match the order of the columns in sql
    public $student_id = "";
    public $user_id = "";
    public $first_name = "";
    public $last_name = "";
    public $email = "";
    public $address = "";
    
    function __construct(array $params = [])
    {
        $this->student_id = uniqid();
        parent::__construct($params);
    }
}
?>
