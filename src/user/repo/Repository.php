<?php
/**
 * User Repository is for basic data update or access to user table.
 * 
 * @author: Ezra Carter
 */
require_once "src/util/sql/BaseSQL.php";
require_once "src/util/sql/Util.php";
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
        $ite->scan(...$user->toRefList());
        $ite->next();

        return $user;
    }

    // create a user
    public function create(string $email, string $password, string $userID = null): string
    {
        $userParams = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'user_id' => $userID ? $userID : uniqid(),
        ]; 
        
        $usr = new User($userParams);
        $createUserQuery = sprintf("INSERT INTO User VALUES (%s)", Sql::getStatementParams(7));

        if(self::$db->mutatorQuery($createUserQuery, "sssisss", ...$usr->toRefList())) {
            return $usr->user_id;
        }



        return "";
    }

    // update a user
    public function update(string $userID, array $updateParams): bool
    {
        $values = [getSqlNow()];
        $columns = "modified = ?";
        $typelist = "ss";
        foreach ($updateParams as $key => $value) {
            if($key === "password") {
                $updateParams[$key] = password_hash($value, PASSWORD_DEFAULT);
            }
            $columns .= ", $key = ?";
            $typelist .= "s";
        }
        $updateUserQuery = sprintf("UPDATE User SET %s WHERE user_id = ?", $columns);
        $values = array_merge($values, array_values($updateParams));
        array_push($values, $userID);
        
        return self::$db->mutatorQuery($updateUserQuery, $typelist, ...$values);
    }

    // verify a users credentials and get the appropriate id
    public function verify(string $email, string $password): string
    {
        $getByEmail = "SELECT * FROM User WHERE email = ?";
        $ite = self::$db->accessorQuery($getUserQuery, "s", $email);

        $user = new User;
        $ite->scan(...$user->toRefList());
        $ite->next();

        if ($user->verifyPassword($password)) {
            return $user->user_id;
        }

        return "";
    }
}

?>
