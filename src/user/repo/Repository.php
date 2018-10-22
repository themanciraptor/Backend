<?php
/**
 * User Repository is for basic data update or access to user table.
 */
include "src/sql/user/model/User.php";
use src\util\sql\BaseSQLInterface;

class UserRepository
{
    private static $db;

    function __construct(BaseSQLInterface $db)
    {
        $this->db = $db;
    }

    public function getUser(string $id)
    {
        $getUserQuery = "SELECT * FROM User WHERE user_id = ?";
        $ite = $db->accessorQuery($getUserQuery, "s", $id);

        $user = new User;
        $ite->scan(...$user->toRefList());
    }
}

?>
