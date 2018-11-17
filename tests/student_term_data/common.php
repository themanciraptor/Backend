<?php
require_once 'src/student_term_data/model/StudentTermData.php';

function getExistingStudentTermData(): StudentTermData
{
    $values = array(
        "student_term_data_id" => "LoveLove",
        "college_id" => "UofS",
        "student_id" => "500XXX",
        "enrollment_status" => "Ignored :(",
        "term" => "FALL/2019",
        '_created' => '2018-10-18 04:05:58',
        '_modified' => '2018-10-18 04:05:58',
    );

    return new StudentTermData($values);
}

?>
