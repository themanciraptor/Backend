<?php
/**
 * User Repository is for basic data update or access to user table.
 */
require_once "src/util/sql/BaseSQL.php";
require_once "src/user/repo/Repository.php";
require_once "src/util/sql/Interface.php";
require_once "src/user/model/User.php";

class UserRepository
{
    private static $db;

    function __construct(SqlInterface $db)
    {
        self::$db = $db;
    }

    // get a user
    public function get(string $id): User
    {
        $getUserQuery = "SELECT * FROM User WHERE user_id = ?";
        $ite = self::$db->accessorQuery($getUserQuery, "s", $id);

        $user = new User;
        $refs = $user->toRefList();
        $ite->scan(...$refs);
        $ite->next();

        return $user;
    }

    // create a user
    public function create($user_id, $first_name, $last_name, $email)
    {
        $usr = new User;
        $usr->user_id = $user_id;
        $usr->first_name = $first_name;
        $usr->last_name = $last_name;
        $usr->email = $email;
        $createUserQuery = "INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?)";
        $res = self::$db->mutatorQuery($createUserQuery, "sssssss", ...$usr->toRefList());
    }
}

?>
