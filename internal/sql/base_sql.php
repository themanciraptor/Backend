<?
//TODO: Create better documentation

/* Sql is used for interfacing with the sql database */
class Sql {
    private $db;

    function __construct($db_name) {
        $address = "localhost";
        $user = "temp_user"; //TODO: Set for our server 
        $password = "temp_password"; // TODO: Set for server

        $this->db = mysqli_connect($address, $user, $password, $db_name);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    function __destruct() {
        $this->db->close();
    }

    function update_query(string $query, string $typeList, &...$params): bool {
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($typeList, ...$params);
        $res = $stmt->execute();
        $stmt->close();

        return $res;
    }

    /* fetch_query returns an iterator so that the client can process each row individually */
    function fetch_query(string $query, string $typeList, &...$params): Iterator {
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($typeList, ...$params);
        $stmt->execute();

        return Iterator($stmt);
    }
}

class Iterator {
    private $stmt;
    private $bound_variables = false;

    function __construct($stmt) {
        $this->stmt = $stmt;
    }

    /* set up the value receivers for all row fields */
    function scan(&...$params) {
        $this->bound_variables = $stmt->bind_result(...$params);
        if (!$this->bound_variables) {
            throw new Exception('Unable to bind receivers to result schema');
        }
    }

    function next(): bool {
        if(!$bound_variables) {
            /* Throw an error if client does not setup value receivers for a row first. */
            throw new Exception('No result receivers set to hold sql row.');
        }
        $fetched = $stmt->fetch();
        if(!$fetched) {
            $stmt->close();
        }

        return $fetched;
    } 
}

?>