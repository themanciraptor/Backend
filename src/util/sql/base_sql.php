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
 *      $db = new Sql("example_db");
 *      $db->mutator_query(&query, "ii", 5, 20); // That's It!
 *  
 *  Accessor Usage:
 *        $query = "SELECT direction, magnitude FROM vectors WHERE direction > ? AND magnitude > ?";
 *        
 *        $db = new Sql("example_db");
 *        $ite = $db->accessorQuery(&query, "ii", 5, 20);
 *        
 *        $direction = $magnitude = 0;
 *        $ite->scan($direction, $magnitude);
 *        $vectors = [];
 *        while($ite->next()) {
 *            $vectors[] = new Vector($direction, $magnitude);
 *        }
 * **/


// Sql is used for interfacing with the sql database
class Sql
{
    private $_db;

    // Constructor with the db name
    function __construct($db_name="SASMA") 
    {
        $address = "localhost";
        $user = "sasmaprojectuser"; //TODO: Set for our server 
        $password = "Where lilies fly, pure maidens doth cry"; // TODO: Set for server

        $this->_db = mysqli_connect($address, $user, $password, $db_name);

        if ($this->_db->connect_error) {
            die("Connection failed: " . $this->_db->connect_error);
        }
    }

    // default destructor
    function __destruct() 
    {
        $this->_db->close();
    }

    function mutatorQuery(string $query, string $typeList, ...$params): bool 
    {
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param($typeList, ...$params);
        $res = $stmt->execute();
        $stmt->close();

        return $res;
    }

    // accessorQuery returns an iterator so that the client can process each row individually
    function accessorQuery(string $query, string $typeList, &...$params): RowIterator 
    {
        $stmt = $this->_db->prepare($query);
        if (count($params) > 0) { 
            $stmt->bind_param($typeList, ...$params);
        }
        $stmt->execute();

        return new RowIterator($stmt);
    }
}

class RowIterator
{
    private $_stmt;
    private $_bound_variables = false;
    public $num_rows = 0;

    // Create an iterator with the connection to a 
    // database using a prepared statement
    function __construct($stmt) 
    {
        $this->_stmt = $stmt;
        $this->num_rows = $stmt->num_rows;
    }

    // set up the value receivers for all row fields
    function scan(&...$params) 
    {
        $this->_bound_variables = $this->_stmt->bind_result(...$params);
        if (!$this->_bound_variables) {
            throw new Exception('Unable to bind receivers to result schema');
        }
    }

    // Retrieve the next row
    function next(): bool 
    {
        if (!$this->_bound_variables) {
            /*
            Throw an error if client does not setup value receivers for a row first.
            */
            throw new Exception('No result receivers set to hold sql row.');
        }
        $fetched = $this->_stmt->fetch();
        if (!$fetched) {
            $this->_stmt->close();
        }

        return (bool)$fetched;
    } 
}

?>
