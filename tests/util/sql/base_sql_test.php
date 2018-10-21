<?php
require "src/util/sql/base_sql.php";
use PHPUnit\Framework\TestCase;

final class TestBaseSQL extends TestCase {
    protected static $dbh;

    public static function setUpBeforeClass()
    {
        self::$dbh = new Sql("SASMA_test");
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
    }

    function test_SqlClassCreatesDBConnection() {
        $query = "SELECT count(*) FROM TestTable WHERE test_name = 'CanIterateOverMultiRowResponse'";

        $ite = $this::$dbh->accessorQuery($query, "");
         
        $count = 0;
        $ite->scan($count);
        $ite->next();

        $this->assertGreaterThan(0, $count);
    }

    function test_CanIterateOverMultiRowResponse() {
        $query = "SELECT int_field, string_field, date_field FROM TestTable WHERE test_name = ? ORDER BY int_field";
        $test_name = "CanIterateOverMultiRowResponse";
        $ite = $this::$dbh->accessorQuery($query, "s", $test_name);

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

    function test_CanInsertAndDeleteData() {
        // insert the value
        $query = "INSERT INTO TestTable VALUES (3, 'inserteddata', '2017-03-01', 'CanInsertAndDeleteData')";
        $this::$dbh->mutatorQuery($query, "");

        $res_query = "SELECT count(*) FROM TestTable WHERE test_name = 'CanInsertAndDeleteData'";

        $ite = $this::$dbh->accessorQuery($res_query, "");
         
        $count = 0;
        $ite->scan($count);
        $ite->next();

        $this->assertEquals(1, $count);

        // Delete the value
        $query = "DELETE FROM TestTable WHERE test_name = 'CanInsertAndDeleteData'";
        $this::$dbh->mutatorQuery($query, "");

        $ite = $this::$dbh->accessorQuery($res_query, "");
         
        $ite->scan($count);
        $ite->next();

        $this->assertEquals(0, $count);
    }
}
?>
