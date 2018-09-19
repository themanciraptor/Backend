<?

/* Sql is used for interfacing with the sql database */
class Sql {
    private $db

    function __construct(db_name) {
        $address = "localhost";
        $user = "temp_user";
        $password = "temp_password");

        $this->$db = mysqli_connect($address, $user, $password, db_name);
    }
}

?>