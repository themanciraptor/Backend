<?php
/**
 * Package SQL is a simple class that abstracts away database connection logic. The intent
 * is that it allows the creation of good code a lot faster.
 * 
 * @author: Ezra Carter
 * 
 * Examples:
 * 
 *  Given the class Vector:
 *      class Vector {
 *          public $magnitude = 0;
 *          public $direction = 0;
 *      
 *          __construct($magnitude, $direction) {
 *              $this->magnitude = $magnitude;
 *              $this->direction = $direction;
 *          }
 *      }
 *  
 *  Mutate Usage:
 *      $query = "INSERT INTO vectors (direction, magnitude) VALUES (?, ?)";
 *      $db = Sql("example_db");
 *      $db->mutator_query(&query, "ii", 5, 20); // That's It!
 *  
 *  Accessor Usage:
 *      $query = "SELECT direction, magnitude FROM vectors WHERE direction > ? AND magnitude > ?";
 *      
 *      $db = Sql("example_db");
 *      $ite = $db->accessor_query(&query, "ii", 5, 20);
 *      
 *      $direction = $magnitude = 0;
 *      $ite->scan($direction, $magnitude);
 *      $vectors = [];
 *      while($ite->next()) {
 *          $vectors[] = new Vector($direction, $magnitude);
 *      }
 * **/


// Sql is used for interfacing with the sql database
class Sql
{
    private $_db;

    // Constructor with the db name
    function __construct($db_name="student") 
    {
        $address = "localhost";
        $user = "temp_user"; //TODO: Set for our server 
        $password = "temp_password"; // TODO: Set for server

        $this->db = mysqli_connect($address, $user, $password, $db_name);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // default destructor
    function __destruct() 
    {
        $this->db->close();
    }

    function mutatorQuery(string $query, string $typeList, ...$params): bool 
    {
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($typeList, ...$params);
        $res = $stmt->execute();
        $stmt->close();

        return $res;
    }

    // accessorQuery returns an iterator so that the client can process each row individually
    function accessorQuery(string $query, string $typeList, &...$params): Iterator 
    {
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($typeList, ...$params);
        $stmt->execute();

        return new Iterator($stmt);
    }
}

class Iterator
{
    private $_stmt;
    private $_bound_variables = false;

    // Create an iterator with the connection to a 
    // database using a prepared statement
    function __construct($stmt) 
    {
        $this->stmt = $stmt;
    }

    // set up the value receivers for all row fields
    function scan(&...$params) 
    {
        $this->bound_variables = $stmt->bind_result(...$params);
        if (!$this->bound_variables) {
            throw new Exception('Unable to bind receivers to result schema');
        }
    }

    // Retrieve the next row
    function next(): bool 
    {
        if (!$bound_variables) {
            /*
            Throw an error if client does not setup value receivers for a row first.
            */
            throw new Exception('No result receivers set to hold sql row.');
        }
        $fetched = $stmt->fetch();
        if (!$fetched) {
            $stmt->close();
        }

        $x = $a;

        return $fetched;
    } 
}

?>
