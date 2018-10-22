<?php
/**
 * User Repository is for basic data update or access to user table.
 */
use src\user\model\User;
use src\util\sql\SqlInterface;

class UserRepository
{
    private static $db;

    function __construct(SqlInterface $db)
    {
        $this->db = $db;
    }

    public function getUser(string $id): User
    {
        $getUserQuery = "SELECT * FROM User WHERE user_id = ?";
        $ite = $db->accessorQuery($getUserQuery, "s", $id);

        $user = new User;
        $ite->scan(...$user->toRefList());

        return $user;
    }
}

?>
