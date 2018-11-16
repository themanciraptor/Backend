<?php
require "src/util/sql/BaseSQL.php";
require_once "src/util/sql/Util.php";
use PHPUnit\Framework\TestCase;

class TestTable {
    public $int_field = 0;
    public $string_field = "";
    public $date_field = "";

    function __construct($int_field, $string_field, $date_field) {
        $this->int_field = $int_field;
        $this->string_field = $string_field;
        $this->date_field = $date_field;
    }
}

final class TestBaseSQL extends TestCase {
    protected static $dbh;
    const getCountQuery = "SELECT count(*) FROM TestTable WHERE test_name = ?";
    const getRowsQuery = "SELECT int_field, string_field, date_field FROM TestTable WHERE test_name = ? ORDER BY int_field";

    public static function setUpBeforeClass()
    {
        self::$dbh = new Sql("SASMA_test");
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
    }

    function test_SqlClassCreatesDBConnection()
    {
        $ite = $this::$dbh->accessorQuery($this::getCountQuery, "s", 'CanIterateOverMultiRowResponse');
         
        $count = 0;
        $ite->scan($count);
        $ite->next();

        $this->assertGreaterThan(0, $count);
    }

    function test_CanIterateOverMultiRowResponse()
    {
        $test_name = "CanIterateOverMultiRowResponse";
        $ite = $this::$dbh->accessorQuery($this::getRowsQuery, "s", $test_name);

        $int_field = 0;
        $string_field = $date_field = "";

        $ite->scan($int_field, $string_field, $date_field);

        $int_at_least = 0;

        $this->assertEquals(3, $ite->num_rows);
        while ($ite->next()) {
            $this->assertGreaterThan($int_at_least, $int_field);
            $this->assertStringStartsWith("t", $string_field);
            $this->assertGreaterThan("2017-00-01", $date_field);
            $int_at_least++;
        }
    }

    function test_CanInsertAndDeleteData()
    {
        $test_name = 'CanInsertAndDeleteData';

        // insert the value
        $query = "INSERT INTO TestTable VALUES (35, 'inserteddata', '2017-03-01', ? )";
        $this::$dbh->mutatorQuery($query, "s", $test_name);

        $ite = $this::$dbh->accessorQuery($this::getRowsQuery, "s", $test_name);
         
        $i = 0;
        $s = $d = "";
        $ite->scan($i, $s, $d);
        $ite->next();

        $this->assertEquals(35, $i);
        $this->assertEquals("inserteddata", $s);
        $this->assertEquals("2017-03-01", $d);

        // Delete the value
        $query = "DELETE FROM TestTable WHERE test_name = ?";
        $this::$dbh->mutatorQuery($query, "s", $test_name);

        $ite = $this::$dbh->accessorQuery($this::getCountQuery, "s", $test_name);
         
        $count = 0;
        $ite->scan($count);
        $ite->next();

        $this->assertEquals(0, $count);
    }

    function test_CanUseObjectsForQueryParams()
    {
        $resultObject = new TestTable(0, "", "");
        $expectedObject = new TestTable(55, "turnaroundbrighteyes", '2018-03-01');
        $ite = $this::$dbh->accessorQuery($this::getRowsQuery, "s", "CanUseListsForQueryParams");

        $ite->scan($resultObject->int_field, $resultObject->string_field,$resultObject->date_field);
        $ite->next();

        $this->assertEquals($expectedObject, $resultObject);
    }
}
?>
