<?php
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/student_term_data/repo/Repository.php';
use PHPUnit\Framework\TestCase;

class StudentTermDataRepositoryTest extends TestCase
{
    protected static $dbh;
    protected static $repo;

    public static function setUpBeforeClass()
    {
        self::$dbh = new Sql("SASMA_test");
        self::$repo = new StudentTermDataRepository(self::$dbh);
    }

    public static function tearDownAfterClass()
    {
        self::$dbh = null;
        self::$repo = null;
    }

    function test_list_ReturnsListOfUniqueSchools()
    {
        $data = self::$repo->list("200361084");

        $this->assertEquals(2, count($data));

        $data = self::$repo->list("200303299");

        $this->assertEquals(1, count($data));
    }
}

?>
