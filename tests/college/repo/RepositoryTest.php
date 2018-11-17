<?php
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/college/repo/Repository.php';
require_once 'tests/college/common.php';
use PHPUnit\Framework\TestCase;

class CollegeRepositoryTest extends TestCase
{
    protected static $dbh;
    protected static $repo;

    public static function setUpBeforeClass()
    {
        self::$dbh = new Sql("SASMA_test");
        self::$repo = new CollegeRepository(self::$dbh);
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
        self::$repo = null;
    }

    function test_list_ReturnsListOfUniqueSchools()
    {
        $colleges = self::$repo->list();

        var_dump($colleges);
        $this->assertGreaterThan(3, count($colleges));
    }
}

?>
