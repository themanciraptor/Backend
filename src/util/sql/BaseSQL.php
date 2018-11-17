<?php

use TheSeer\Tokenizer\Exception;
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
 *      $db->mutatorQuery($query, "ii", 5, 20); // That's It!
 *  
 *  Accessor Usage:
 *      $query = "SELECT direction, magnitude FROM vectors WHERE direction > ? AND magnitude > ?";
 *      
 *      $db = new Sql("example_db");
 *      $ite = $db->accessorQuery($query, "ii", 5, 20);
 *      
 *      $direction = $magnitude = 0;
 *      $ite->scan($direction, $magnitude);
 *      $vectors = [];
 *      while($ite->next()) {
 *          $vectors[] = new Vector($direction, $magnitude);
 *      }
 * **/
require_once 'Interface.php';

// Sql is used for interfacing with the sql database
class Sql implements SqlInterface
{
    private $_db;

    // Constructor with the db name
    function __construct($db_name="SASMA") 
    {
        $address = "localhost";
        $user = "sasmaprojectuser";
        $password = "Where lilies fly, pure maidens doth cry";

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
        if (!$stmt) {
            throw new SqlPreparedStatementException(sprintf("Unable to prepare mutator query: %s", $this->_db->error));
        }

        if (count($params) > 0) {
            $stmt->bind_param($typeList, ...$params);
        }
        $res = $stmt->execute();
        if(sizeof($stmt->error_list) > 0) {
            throw new SqlDataInputException(sprintf("Data mutation failed: %s", json_encode($stmt->error_list)));
        }
        $stmt->close();

        return $res;
    }

    // accessorQuery returns an iterator so that the client can process each row individually
    function accessorQuery(string $query, string $typeList, ...$params): RowIteratorInterface
    {
        $stmt = $this->_db->prepare($query);
        if (!$stmt) {
            throw new SqlPreparedStatementException(sprintf("Unable to prepare accessor query: %s", $this->_db->error));
        }
        if (count($params) > 0) { 
            $stmt->bind_param($typeList, ...$params);
        }
        $stmt->execute();
        // Store the result so that we can know how many values are returned
        $stmt->store_result();

        return new RowIterator($stmt);
    }
        
    // From an int get string containing the number of parameters needed for a prepared statement
    // e.g. getStatementParams(4) returns "?,?,?,?"
    public static function getStatementParams(int $num): string
    {
        $parameterString = "?";
        for ($i = 1; $i < $num; $i++) {
            $parameterString .= ",?";
        }

        return $parameterString;
    }
}

class RowIterator implements RowIteratorInterface
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

        // Added type cast since stmt->fetch() returns null when there is no more data :|
        return (bool)$fetched;
    }
}

class SqlPreparedStatementException extends \Exception
{
    /* For exceptions cause by failure of the sql to create a prepared statement query */
    function __construct(string $message, int $code = 500, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class SqlDataInputException extends \Exception
{
    /* For exceptions caused when data in queries is invalid */
    function __construct(string $message, int $code = 500, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

?>
