<?php
require_once 'src/student/model/Student.php';

function getExistingStudent(): Student
{
    $values = array(
        "user_id" => "testid",
        'student_id' => '200361084',
        "first_name" => "Jonah",
        "last_name" => "Wrubleski",
        "email" => "jjwrubleski21@gmail.com",
        "address" => "Ma house",
        '_created' => '2018-10-18 04:05:58',
        '_modified' => '2018-10-18 04:05:58',
    );

    return new Student($values);
}

?>
