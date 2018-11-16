<?php
// require_once 'src/util/sql/BaseSQL.php';
// require_once 'src/user/repo/Repository.php';
require_once 'src/user/model/User.php';

function getExistingUser(): User
{
    $values = array(
        "user_id" => "st-000001",
        "password" => "mahpassword",
        "email" => "redsocs@rus.com",
        "is_admin" => false,
        "_created" => "2018-10-18 04:05:58",
        "_modified" => "2018-10-18 04:05:58",
        "_deleted" => Null
    );

    return new User($values);
}

?>
