<?php
// require_once 'src/util/sql/BaseSQL.php';
// require_once 'src/user/repo/Repository.php';
require_once 'src/user/model/User.php';

function getExistingUser(): User
{
    $values = array(
        "first_name" => "Carl",
        "last_name" => "Marks",
        "user_id" => "st-000001",
        "email" => "redsocs@rus.com",
        "_created" => "2018-10-18 04:05:58",
        "_updated" => "2018-10-18 04:05:58",
        "_deleted" => Null
    );

    return new User($values);
}

?>
