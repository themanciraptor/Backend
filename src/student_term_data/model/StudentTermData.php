<?php
/**
 * This is the model of a Students term data
 * 
 * @author: Ezra Carter
 * 
 */
require_once "src/util/model/BaseModel.php";

class StudentTermData extends BaseModel
{
    // Note that these fields must match the order of the columns in sql
    public $student_term_data_id = "";
    public $college_id = "";
    public $student_id = "";
    public $enrollment_status = "";
    public $term = "";
    
    function __construct(array $params = [])
    {
        $this->student_term_data_id = uniqid();
        parent::__construct($params);
    }
}
?>
