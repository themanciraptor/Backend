<?php
require "src/util/sql/BaseSQL.php";
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    protected static $dbh;

    public static function setUpBeforeClass()
    {
        self::$dbh = new Sql("SASMA_test");
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
    }
}

?>
