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
            '_password' => password_hash($password, PASSWORD_DEFAULT),
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
    public function update(User $user): bool {
        $query = $user->updatePasswordStatement(new QueryBuilder("UPDATE User SET %s WHERE %s"))
            ->addFilter("user_id", "s", $user->user_id)
            ->addModified();

        $vars = get_object_vars($user);
        foreach ($vars as $key => $value) {
            $query->addStatement($key, "s", $value);
        }

        return $query->doQuery(function($query, $typelist, ...$values): bool {
            return self::$db->mutatorQuery($query, $typelist, ...$values
        );});
    }

    // verify a users credentials and get the appropriate id
    public function verify(string $email, string $password): string
    {
        $getByEmail = "SELECT * FROM User WHERE email = ?";
        $ite = self::$db->accessorQuery($getByEmail, "s", $email);

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
