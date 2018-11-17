<?php
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/college/repo/Repository.php';
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
        $expectedCollege0 = new College([
            'college_id' => "MacU",
            'name' => "MacEwan University",
            'address' => "10700 - 104 104 Avenue, Edmonton, AB",
            '_created' => "2018-11-17 10:34:16",
            '_modified' => "2018-11-17 10:34:16",
            '_deleted' => NULL,
        ]);
        $colleges = self::$repo->list();

        $this->assertGreaterThan(3, count($colleges));
        $this->assertEquals($expectedCollege0, $colleges[0]);
    }
}

?>
