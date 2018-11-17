<?php
require_once 'src/util/sql/BaseSQL.php';
require_once 'src/student_term_data/repo/Repository.php';
require_once 'tests/student_term_data/common.php';
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
        $this->assertEquals(8, count($data[0]->toRefList()));


        $data = self::$repo->list("200303299");

        $this->assertEquals(8, count($data[0]->toRefList()));
        $this->assertEquals(1, count($data));
    }

    function test_create_CreatesAStudent()
    {
        $std = getExistingStudentTermData();

        $this::$repo->create(get_object_vars($std));

        $result = self::$repo->list($std->student_id);
        $result = $result[0];
        try{
            $this->assertEquals($std->student_id, $result->student_id);
            $this->assertEquals($std->college_id, $result->college_id);
            $this->assertEquals($std->student_term_data_id, $result->student_term_data_id);
            $this->assertEquals($std->enrollment_status, $result->enrollment_status);
            $this->assertEquals($std->term, $result->term);
            $this->assertEquals(8, count($result->toRefList()));
            $this->assertNotNull($result->getCreated());
            $this->assertNotNull($result->getModified());
        } finally {
            self::delete($std->student_term_data_id);
        }
    }

    private static function delete($id)
    {
        self::$dbh->mutatorQuery("DELETE FROM StudentTermData WHERE student_term_data_id = ?", "s", $id);
    }
}

?>
